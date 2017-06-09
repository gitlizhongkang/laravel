@extends('layouts.admin-header')


@section('content')

    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="r">角色：<strong>{{$roleName}}</strong> </span>
    </div>

    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort">
            <thead>
            <tr class="text-c">
                <th>选择</th>
                <th>管理员姓名</th>
                <th>管理员邮件</th>
            </tr>
            </thead>
            <tbody>
            @foreach($dataAdmin as $val)
                <tr class="text-c va-m" id="{{$val->id}}">
                    <td><input type="checkbox" class="check"></td>
                    <td>{{$val->name}}</td>
                    <td>{{$val->email}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


    <form action="{{url('/admin-rbac-bindRoleToUser')}}" method="post" class="form form-horizontal" id="form-article-add">
        {{csrf_field()}}
        <input type="hidden" name="role_id"  id="role" value="{{$roleId}}">
        <div id="admin" style="display: none"></div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <input type="submit" class="btn btn-primary radius" value="给管理员绑定角色">
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
                var adminId = _self.parents('tr').attr('id');
                var roleId = $('#role').val();
                var str = '';
                var url = '{{url('/admin-rbac-checkRoleToUser')}}';

                //检测手否拥有此权限
                $.getJSON(url, {adminId:adminId, roleId:roleId}, function (response) {

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
                            str += '<input type="hidden" id="input_' + adminId + '" name="admin_id[]" value="' + adminId + '">';
                            $('#admin').append(str);
                        }
                        else
                        {
                            $('#input_' + adminId).remove()
                        }

                    }
                });
            })
        })
    </script>
@endsection



