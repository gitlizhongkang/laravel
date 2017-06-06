@extends('layouts.admin-header')


@section('content')

    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="r">权限：<strong>{{$permissionName}}</strong> </span>
    </div>

    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort">
            <thead>
            <tr class="text-c">
                <th>选择</th>
                <th>角色</th>
                <th>角色名</th>
                <th>角色描述</th>
            </tr>
            </thead>
            <tbody>
            @foreach($dataRole as $val)
                <tr class="text-c va-m" id="{{$val->id}}">
                    <td><input type="checkbox" class="check"></td>
                    <td>{{$val->name}}</td>
                    <td>{{$val->display_name}}</td>
                    <td>{{$val->description}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


    <form action="{{url('/admin-rbac-bindPermissionToRole')}}" method="post" class="form form-horizontal" id="form-article-add">
        {{csrf_field()}}
        <input type="hidden" name="permission_id"  id="permission" value="{{$permissionId}}">
        <div id="role" style="display: none"></div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <input type="submit" class="btn btn-primary radius" value="给角色绑定权限">
            </div>
        </div>
    </form>
    
@stop


@section('js')
    <script type="text/javascript" src="plug/hadmin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
    <script type="text/javascript" src="plug/hadmin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
    <script type="text/javascript" src="plug/hadmin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
    <script>
        //表单验证
        $("#form-article-add").validate({
            rules:{},
            onkeyup:false,
            focusCleanup:true,
            success:"valid",
            submitHandler:function(form){
                $(form).ajaxSubmit();
                var index = parent.layer.getFrameIndex(window.name);
                parent.layer.close(index);
            }
        });



        $(function () {
            $('.check').click(function () {
                var _self = $(this);
                var roleId = _self.parents('tr').attr('id');
                var permissionId = $('#permission').val();
                var str = '';
                var url = '{{url('/admin-rbac-checkPermissionToRole')}}';

                //检测手否拥有此权限
                $.getJSON(url, {permissionId:permissionId, roleId:roleId}, function (response) {

                    if (response.code == 1)
                    {
                        layer.msg(response.msg, {icon: 5,time:1000});
                        _self.remove();
                        return false;
                    }
                    else
                    {
                        if (_self.prop('checked') === true)
                        {
                            str += '<input type="hidden" id="input_' + roleId + '" name="role_id[]" value="' + roleId + '">';
                            $('#role').append(str);
                        }
                        else
                        {
                            $('#input_' + roleId).remove()
                        }

                    }
                });
            })
        })
    </script>
@endsection



