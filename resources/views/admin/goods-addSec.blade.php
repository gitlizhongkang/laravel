@extends('layouts.admin-header')


@section('content')

    <div class="page-container">
        <form action="{{url('/admin-goods-addSec')}}" method="post" class="form form-horizontal" id="form-article-add">
            {{csrf_field()}}
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">商品名称：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="{{$dataOneGoods->goods_name}}" name="goods_name" readonly style="width:360px;">
                    <input type="hidden" value="{{$dataOneGoods->goods_id}}" name="goods_id">
                    <input type="hidden" value="{{$dataOneGoods->goods_desc}}" name="goods_desc">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">货号：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="{{$dataOneGoods->goods_sn}}" name="goods_sn" readonly style="width:360px;">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">分类：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="{{$dataOneGoods->category_name}}" name="category_name" readonly style="width:360px;">
                    <input type="hidden" value="{{$dataOneGoods->category_id}}" name="category_id" >
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">品牌：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="{{$dataOneGoods->brand_name}}" name="brand_name" readonly style="width:360px;">
                    <input type="hidden" value="{{$dataOneGoods->brand_id}}" name="brand_id">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">图片：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <img src="{{$dataOneGoods->goods_img}}" width="140" height="120">
                    <input type="hidden" value="{{$dataOneGoods->goods_img}}" name="goods_img">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">原价：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="{{$dataOneGoods->goods_low_price}}" name="original_price" readonly style="width:360px;">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">销售开始时间：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" name="start_time" placeholder="请输入开始时间" required onfocus="WdatePicker({ dateFmt:'yyyy-MM-dd HH:mm:ss',maxDate:'' })" id="datemin" class="input-text Wdate" style="width:180px;">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">销售结束时间：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" name="end_time" placeholder="请输入结束时间" required onfocus="WdatePicker({ dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'#F{$dp.$D(\'datemin\')}' })" id="datemax" class="input-text Wdate" style="width:180px;">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">总数量：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" name="num" readonly required style="width:360px;">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">规格价格数量：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <table>
                        <thead>
                            <tr>
                                <th>商品规格</th>
                                <th>商品库存</th>
                                <th>秒杀数量</th>
                                <th>秒杀价格</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($dataGoodsSku as $val)
                            <tr>
                                <input type="hidden" name="sku_id[]" value="{{$val->sku_id}}">
                                <td>{{$val->sku_norms}}</td>
                                <td>{{$val->sku_num}}</td>
                                <td><input type="text" name="second_num[]" class="input-text" required></td>
                                <td><input type="text" name="second_price[]" class="input-text" required></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row cl">
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                    <input type="submit" value="创建秒杀商品" class="btn btn-secondary radius">
                </div>
            </div>
        </form>
    </div>

@stop


@section('js')
    <script type="text/javascript" src="plug/hadmin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
    <script>
        $(function () {
            //改变数量
            $('input[name="second_num[]"]').keyup(function () {
                var totalNum = parseInt($(this).parent().prev().html());
                var inputNum = parseInt($(this).val());

                if(inputNum > totalNum)
                {
                    layer.msg('不能大于库存',{icon:2, time:2000});
                    $(this).val(0);
                }

                var numObj = $('input[name="second_num[]"]');
                var num = 0;
                var length = numObj.length;

                for (var i = 0; i < length; i++) {

                    if (numObj[i].value == '') {
                        num += 0;
                    } else {
                        num += parseInt(numObj[i].value);
                    }
                }
                $('input[name="num"]').val(num)
            });
        })
    </script>
@stop

