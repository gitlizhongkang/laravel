@extends('layouts.home-header')

@section('content')
    <link href="css/cart.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/shopping_flow.js"></script>
    <script type="text/javascript" src="js/utils.js"></script>
    <script type="text/javascript" src="js/xiaomi_flow.js"></script>

    <div class="xm-bg">
        <div class="page_main">
            <div class="container" style="background:#fff;">
                <div class="section section-order">
                    <div class="order-info clearfix">
                        <div class="fl">
                        </div>
                        <div class="fr">
                        </div>
                    </div>
                    <i class="iconfont icon-right">X</i>
                    <div class="order-detail">
                        <ul>
                            <li class="clearfix">
                                {{$goods_name.'  '.$sku_norms}}  商品数量不足！返回 <a href="home-cart-index" style="font-size: 22px">购物车</a> 进行修改
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--脚部-->
@endsection

