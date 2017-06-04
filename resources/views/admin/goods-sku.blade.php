@extends('layouts.admin-header')


@section('content')

    <div>
        <div class="page-container">
            <span class="r">共有数据：<strong>{{count($dataGoodsSku)}}</strong> 条</span>
        </div>

        <div class="mt-20">
                <table class="table table-border table-bordered table-bg table-hover table-sort">
                    <thead>
                    <tr class="text-c">
                        <th><input name="" type="checkbox" value=""></th>
                        <th>SKU_ID</th>
                        <th>GOODS_ID</th>
                        <th>sku货号</th>
                        <th>商品名称</th>
                        <th>最小规格</th>
                        <th>价格</th>
                        <th>库存</th>
                        <th>缩略图</th>
                        <th>秒杀数量</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dataGoodsSku as $val)
                        <tr class="text-c va-m" id="{{$val->sku_id}}">
                            <td><input type="checkbox"></td>
                            <td>{{$val->sku_id}}</td>
                            <td>{{$val->goods_id}}</td>
                            <td>{{$val->sku_sn}}</td>
                            <td class="text-l"><b class="text-success">{{$val->goods_name}}</b></td>
                            <td class="text-l">{{$val->sku_norms}}</td>
                            <td class="text-l" field="sku_price"><span class="update">{{$val->sku_price}}</span></td>
                            <td class="text-l" field="sku_num"><span class="update">{{$val->sku_num}}</span></td>
                            <td><a href="javascript:;"><img width="60" class="product-thumb" src="{{$val->sku_img}}"></a></td>
                            <td class="text-l" field="second_num"><span class="update">{{$val->second_num}}</span></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
    </div>

@stop


@section('js')
    @permission('update')
    <script type="text/javascript">
        $(function () {

            var oldVal, field;
            $(document).on('click','.update',function(){
                oldVal = $(this).html();
                field = $(this).parent().attr('field');
                $(this).parent().html('<input class="temp" type="text" size="8" value="'+oldVal+'">');
                $('.temp').focus();
            });
            $(document).on('blur','.temp',function(){
                var obj = $(this);
                var newVal = obj.val();
                var skuId = obj.parents('tr').attr('id');
                var url = '{{url('/admin-goods-updateSku')}}';

                if(oldVal === newVal)
                {
                    obj.parent().html('<span class="update">'+ oldVal +'</span>');
                }
                else if(oldVal !== newVal)
                {
                    //发送请求
                    $.getJSON(url, {field:field, newVal:newVal, id:skuId}, function (response) {
                        if (response.code == 1)
                        {
                            layer.msg('修改成功', {icon: 6,time:1000});
                            obj.parent().html('<span class="update">'+ newVal +'</span>');
                        }
                        else if (response.code == 0)
                        {
                            layer.msg(response.msg, {icon: 5,time:1000});
                            obj.parent().html('<span class="update">'+ oldVal +'</span>');
                        }
                    });
                }
            });
        });
    </script>
    @endpermission
@endsection
