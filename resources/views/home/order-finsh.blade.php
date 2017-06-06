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
                        <h2 class="title">感谢您在本店购物！您的订单已提交成功，请记住您的订单号 <b>{{$order_sn}}</b></h2>
                    </div>
                    <div class="fr">
                        <p class="total">您的应付款金额为 <span class="money"><em>{{$order_price}}<em>元</em></em></span></p>
                    </div>
                </div>
                <i class="iconfont icon-right">√</i>
                <div class="order-detail">
                    <ul>
                        <li class="clearfix">
                            <div class="label">订单号:</div>
                            <div class="content"><div class="order-num">{{$order_sn}}</div></div>
                        </li>
                        <li class="clearfix">
                            <div class="label">支付时间:</div><div class="content ">请在<em style="font-size: 20px;color: limegreen">30分钟</em>内完成支付</div>
                        </li>
                        <li class="clearfix">
                            <div class="label">您选定的配送方式为:</div><div class="content">{{$logistics_type}}</div>
                        </li>
                        <li class="clearfix">
                            <div class="label">您选定的支付方式为:</div><div class="content">{{$pay_type}}</div>
                        </li>
                        <li class="clearfix">
                            <div class="label">您的应付款金额为:</div><div class="content money"><em>{{$order_price}}<em>元</em></em></div>
                        </li>

                    </ul>
                </div>
            </div>

            <div class="section section-payment">
                <div class="pay_action">
                    <div style="text-align:center">
                        <form action="home-pay" class="alipayform" method="post">
                            <input type="hidden" name="WIDout_trade_no" value="{{$order_sn}}">
                            <input type="hidden" name="WIDsubject" value="test商品123">
                            <input type="hidden" name="WIDtotal_fee" value="{{$order_price}}">
                            <input type="hidden" name="WIDbody" value="即时到账测试">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="submit" value="立即使用支付宝支付" />
                        </form>
                    </div>
                </div>
            </div>

            <p style="text-align:center; margin-bottom:36px;">您可以 <a href="index.php">返回首页</a> 或去 <a href="home-personal-index">用户中心</a></p>
        </div>
    </div>
</div>


<!--脚部-->
@endsection

