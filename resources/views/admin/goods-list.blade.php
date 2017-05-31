@extends('layouts.admin-header')


@section('content')

    <div>
        <nav class="breadcrumb">
            <i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品管理 <span class="c-gray en">&gt;</span> 产品列表
            <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" >
                <i class="Hui-iconfont">&#xe68f;</i>
            </a>
        </nav>
        <div class="page-container">
            <form method="post">
                {{csrf_field()}}
                <div class="text-c"> 日期范围：
                    <input type="text" name="strt_time" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}' })" id="logmin" class="input-text Wdate" style="width:120px;">
                    -
                    <input type="text" name="end_time" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d' })" id="logmax" class="input-text Wdate" style="width:120px;">
                    <input type="text" name="goods_name"  placeholder="产品名称" style="width:250px" class="input-text">
                    <button class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜产品</button>
                </div>
            </form>

            <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l">
                <a href="javascript:;" class="btn btn-danger radius deleteAll">
                    <i class="Hui-iconfont">&#xe6e2;</i> 批量删除
                </a>
                <a class="btn btn-primary radius" onclick="product_add('添加商品','{{url('/admin-goods-addView')}}')" href="javascript:;">
                    <i class="Hui-iconfont">&#xe600;</i> 添加产品
                </a>
                <a class="btn btn-primary radius" onclick="product_addSec('修改为秒杀商品')" href="javascript:;">
                    <i class="Hui-iconfont">&#xe600;</i> 修改为秒杀商品
                </a>
            </span>
                <span class="r">共有数据：<strong>{{count($dataGoods)}}</strong> 条</span>
            </div>

            <div class="mt-20">
                <table class="table table-border table-bordered table-bg table-hover table-sort">
                    <thead>
                    <tr class="text-c">
                        <th><input name="" type="checkbox" value=""></th>
                        <th>ID</th>
                        <th>货号</th>
                        <th>商品名称</th>
                        <th>最低价</th>
                        <th>分类</th>
                        <th>品牌</th>
                        <th>缩略图</th>
                        <th>上架商品</th>
                        <th>秒杀商品</th>
                        <th>热卖商品</th>
                        <th>积分商品</th>
                        <th>添加时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dataGoods as $val)
                        <tr class="text-c va-m" id="{{$val->goods_id}}">
                            <td><input type="checkbox"></td>
                            <td>{{$val->goods_id}}</td>
                            <td>{{$val->goods_sn}}</td>
                            <td class="text-l"><b class="text-success">{{$val->goods_name}}</b></td>
                            <td><span class="price">{{$val->goods_low_price}}</span></td>
                            <td class="text-l">{{$val->category_name}}</td>
                            <td class="text-l">{{$val->brand_name}}</td>
                            <td><a href="javascript:;"><img width="60" class="product-thumb" src="{{$val->goods_img}}"></a></td>
                            <td class="td-status">
                                @if($val->is_on_sale)  <span class="label label-success radius" field="is_on_sale">是@else <span class="label label-danger radius" field="is_on_sale">否@endif</span>
                            </td>
                            <td class="td-status">
                                @if($val->is_second)  <span class="label label-success radius sec_status" field="is_second">是@else <span class="label label-danger radius sec_status" field="is_second">否@endif</span>
                            </td>
                            <td class="td-status">
                                @if($val->is_hot)  <span class="label label-success radius" field="is_hot">是@else <span class="label label-danger radius" field="is_hot">否@endif</span>
                            </td>
                            <td class="td-status">
                                @if($val->is_point)  <span class="label label-success radius" field="is_point">是@else <span class="label label-danger radius" field="is_point">否@endif</span>
                            </td>
                            <td>{{$val->add_time}}</td>
                            <td class="td-manage">
                                <a style="text-decoration:none" class="ml-5" onClick="product_show('产看sku', '{{url('/admin-goods-skuView')}}?id={{$val->goods_id}}')" href="javascript:;" title="查看sku">
                                    <i class="Hui-iconfont">&#xe6df;</i>
                                </a>
                                <a style="text-decoration:none" class="ml-5" onClick="product_del('{{$val->goods_id}}')" href="javascript:;" title="删除">
                                    <i class="Hui-iconfont">&#xe6e2;</i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
               <style>
                   .pagination li {float: left; margin: 6px 3px; padding: 0 5px; font-weight: bold; font-size: 14px; border: 2px solid #9C9C9C}
               </style>
                {{$dataGoods->links()}}
            </div>
        </div>
    </div>

@stop


@section('js')
    <script type="text/javascript" src="plug/hadmin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
    <script type="text/javascript">
        $(function () {
            //特性修改
            $('.label').click(function () {
                var _self = $(this);
                layer.confirm('确认要修改产品特性吗？',function(){
                    var field = _self.attr('field');
                    var content = _self.html();
                    var id = _self.parents('tr').attr('id');
                    var url = "{{url('/admin-goods-updateStatus')}}";

                    //判断状态
                    if (content === '是')
                    {
                        var status = 0;
                    }
                    else if (content === '否')
                    {
                        var status = 1;
                    }

                    //发送请求
                    $.getJSON(url, {field:field, status:status, id:id}, function (response) {
                        if (response.code == 1)
                        {
                            layer.msg('修改成功', {icon: 6,time:1000});
                            if (status == 0)
                            {
                                _self.html('否');
                                _self.addClass('label-danger').removeClass('label-success')
                            }
                            else if (status == 1)
                            {
                                _self.html('是');
                                _self.addClass('label-success').removeClass('label-danger')
                            }
                        }
                        else if (response.code == 0)
                        {
                            layer.msg(response.msg, {icon: 5,time:1000});
                        }
                    });
                });
            });
        });

        /*商品-添加*/
        function product_add(title,url){
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        }

        /*秒杀商品-添加*/
        function product_addSec(title){
            var tr = $('input[type="checkbox"]:checked').parents('tr');
            var status = tr.find('.sec_status').html();
            var id = tr.attr('id');
            var url = "{{url('/admin-goods-addSecView')}}" + '?id=' +id;


            if (tr.length !== 1 || status !== '是')
            {
                layer.msg('请选择一条数据，且该数据是否秒杀状态必须为`是`',{icon:2, time:2000});
                return false;
            }
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        }

        /*sku-查看*/
        function product_show(title,url){
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        }

        /*产品-删除*/
        function product_del(id){
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
