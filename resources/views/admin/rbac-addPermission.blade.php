@extends('layouts.admin-header')


@section('content')

    <div class="page-container">
        <form action="{{url('/admin-rbac-addPermission')}}" method="post" class="form form-horizontal" id="form-article-add">
            {{csrf_field()}}
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">权限：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" name="name" required style="width:360px;">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">权限名：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" name="display_name" required style="width:360px;">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">描述：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" name="description" required style="width:360px;">
                </div>
            </div>
            <div class="row cl">
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                    <input type="submit" value="创建权限" class="btn btn-secondary radius">
                </div>
            </div>
        </form>
    </div>

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
    </script>
@stop



