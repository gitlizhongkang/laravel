@extends('layouts.home-header')

@section('content')
    <link href="css/category.css" rel="stylesheet" type="text/css" />


    <!--通栏-->
    <div class="breadcrumbs">
        <div class="container">
            <a href="{{URL::to('/')}}">首页</a>
            <code>&gt;</code> <a href="#">秒杀商品</a>
        </div>
    </div>

    <!--内容展示-->
    <div class="content">
        <div class="container">
            <!--排序-->
            <div class="order-list-box clearfix">
                <ul class="type-list">
                    <li>显示方式：</li>
                    <li> <a href="javascript:;" onClick="javascript:display_mode('list')"><img src="images/display_mode_list.gif" alt=""></a></li>
                    <li><a href="javascript:;" onClick="javascript:display_mode('grid')"><img src="images/display_mode_grid_act.gif" alt=""></a></li>
                    <li><a href="javascript:;" onClick="javascript:display_mode('text')"><img src="images/display_mode_text.gif" alt=""></a></li>&nbsp;&nbsp;
                </ul>
            </div>

            <!--内容-->
            <div class="goods-list-box">
                <div class="goods-list clearfix">
                    @if (!empty($dataSec))
                        @foreach ($dataSec as $val)
                            <a href="{{url('home-secKill-secInfo')}}?goods_id={{$val['goods_id']}}">
                                <div class="goods-item">
                                    <div class="figure figure-img">
                                        <img src="{{$val['goods_img']}}" alt="{{$val['goods_name']}}" class="goodsimg" />
                                    </div>
                                    <p class="desc">{{$val['brand_name']}}</p>
                                    <h2 class="title">
                                        {{$val['goods_name']}}
                                    </h2>
                                    <p class="price">
                                        开始时间：<font class="shop_s">{{$val['start_time']}}</font>
                                    </p>
                                    <div class="flags">
                                        <div class="flag flag-saleoff">{{$val['second_price']}}元  秒杀</div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @else
                        <div class="goods-item" style="margin-left: 30%">
                            <h2>
                                今天没有秒杀商品！！！
                            </h2>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection