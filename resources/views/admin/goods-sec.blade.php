@extends('layouts.admin-header')


@section('content')

    <div>
        <div class="page-container">
            <span class="r">商品秒杀详情信息</span>
        </div>

        <div class="mt-20">
            <table class="table table-border table-bordered table-bg table-hover table-sort">
                    <thead>
                    <tr class="text-c">
                        <th><input name="" type="checkbox" value=""></th>
                        <th>ID</th>
                        <th>货号</th>
                        <th>商品名称</th>
                        <th>原最低价</th>
                        <th>秒杀价</th>
                        <th>分类</th>
                        <th>品牌</th>
                        <th>缩略图</th>
                        <th>开始时间</th>
                        <th>结束时间</th>
                        <th>数量</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>{{$dataGoodsSec->goods_id}}</td>
                        <td>{{$dataGoodsSec->goods_sn}}</td>
                        <td class="text-l"><b class="text-success">{{$dataGoodsSec->goods_name}}</b></td>
                        <td><span class="price">{{$dataGoodsSec->original_price}}</span></td>
                        <td><span class="price">{{$dataGoodsSec->second_price}}</span></td>
                        <td class="text-l">{{$dataGoodsSec->category_name}}</td>
                        <td class="text-l">{{$dataGoodsSec->brand_name}}</td>
                        <td><a href="javascript:;"><img width="60" class="product-thumb" src="{{$dataGoodsSec->goods_img}}"></a></td>
                        <td class="text-l">{{$dataGoodsSec->start_time}}</td>
                        <td class="text-l">{{$dataGoodsSec->end_time}}</td>
                        <td class="text-l">{{$dataGoodsSec->num}}</td>
                    </tr>
                    </tbody>
                </table>
        </div>

    </div>

@stop


