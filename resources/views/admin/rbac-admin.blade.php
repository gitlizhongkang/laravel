@extends('layouts.admin-header')


@section('content')

    <div>
        <nav class="breadcrumb">
            <i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 管理员列表
            <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" >
                <i class="Hui-iconfont">&#xe68f;</i>
            </a>
        </nav>

        <div class="cl pd-5 bg-1 bk-gray mt-20">
                <span class="l">
                    <a href="javascript:;" class="btn btn-danger radius deleteAll">
                        <i class="Hui-iconfont">&#xe6e2;</i> 批量删除
                    </a>

                    <a class="btn btn-primary radius" onclick="admin_add('添加管理员','')" href="javascript:;">
                        <i class="Hui-iconfont">&#xe600;</i> 添加管理员
                    </a>
                </span>
            <span class="r">共有数据：<strong>{{count($dataAdmin)}}</strong> 条</span>
        </div>

        <div class="mt-20">
            <table class="table table-border table-bordered table-bg table-hover table-sort">
                <thead>
                <tr class="text-c">
                    <th><input name="" type="checkbox" value=""></th>
                    <th>姓名</th>
                    <th>邮件</th>
                    <th>角色</th>
                    <th>权限</th>
                    <th>创建时间</th>
                    <th>修改时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($dataAdmin as $val)
                    <tr class="text-c va-m" id="{{$val['id']}}">
                        <td><input type="checkbox"></td>
                        <td>{{$val['name']}}</td>
                        <td>{{$val['email']}}</td>
                        <td>{{$val['role']}}</td>
                        <td>{{$val['permission']}}</td>
                        <td>{{$val['created_at']}}</td>
                        <td>{{$val['updated_at']}}</td>
                        <td class="td-manage">
                            <a style="text-decoration:none" class="ml-5" onClick="admin_del('{{$val['id']}}')" href="javascript:;" title="删除">
                                <i class="Hui-iconfont">&#xe6e2;</i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop


@section('js')
    <script>
        /*角色-添加*/
        function admin_add(title,url){
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        }


        /*角色-删除*/
        function admin_del(id){
            layer.confirm('确认要删除吗？',function(index){
                var url = '';
                //发送请求
                $.getJSON(url, {id:id}, function (response) {
                    if (response.code == 1)
                    {
                        layer.msg('修改成功', {icon: 6,time:1000});
                    }
                    else if (response.code == 0)
                    {
                        layer.msg(response.msg, {icon: 5,time:1000});
                    }
                });
            });
        }
    </script>

@endsection
