@extends('layouts.home-header')

@section('content')
    <link href="css/cart.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/xiaomi_flow.js"></script>
    <script type="text/javascript" src="js/parsonal/userAddress.js"></script>
<body>

<div class="page-main">
    <div class="container clearfix">
        <div class="checkout-box confirm-order-box">
            <h2>确认订单信息页面</h2>
            <div class="flowBox_in">
                <form action="home-secKill-order" method="post" name="theForm" id="theForm">
                    {{ csrf_field() }}

                    <ul class="box-main clearfix">
                        <li class="section-options clearfix">
                            <h3 class="section-header" style="height: 80px"><span>收货人信息</span></h3>
                            <div style="width:1300px;" class="addrss">
                            @if (!empty($userAddress))
                                @foreach ($userAddress as $val)
                                <div class="section-body" style="width: 450px">
                                    <span><input type="radio" name="userAddress" value="{{$val['id']}}" @if($val['is_default'] == 1) checked @endif></span>
                                    <span class="addr-name">{{$val['address_name']}}</span>
                                    <span class="addr-info">{{$val['province']}} {{$val['city']}} {{$val['district']}} {{$val['address']}} </span>
                                    <span class="addr-tel">{{$val['address_tel']}}</span>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </div>
                                @endforeach
                            @endif
                            </div>
                            <div  style="display: inline-block;width: 35px;border:1px solid #d9d9d9;" align="center" status="1" class="add"><a href="#">新增地址</a></div>
                        </li>
                        <li class="section-options clearfix" style="display:none;">
                            收货人：<input type="text" id="address_name">
                            电话：<input type="text" name="" id="address_tel">
                            配送地址：
                                <select name="" class="province">
                                    <option value="">请选择省</option>
                                    @foreach ($province as $v)
                                        <option value="{{ $v['district_id'] }}" district="{{ $v['district_name'] }}">{{ $v['district_name'] }}</option>
                                    @endforeach
                                </select>
                                <select name="" class="city">
                                    <option value="">请选择市</option>
                                </select>
                                <select name="" class="district" style="display:none">
                                    <option value="">请选择区</option>
                                </select>
                            详细地址：<input type="text" name="" id="address">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="#"><span style="display:inline-block;width: 50px;hight:20px;padding-left: 17px;background-color:#F2F0F1;border:1px solid #d9d9d9;" class="addUserAddress" >确定</span></a>
                        </li>

                        <li class="section-options clearfix">
                            <h3 class="section-header"><span>支付方式</span></h3>
                            <div class="section-body">
                                <ul class="item-list clearfix payment-list" id="payment-list">
                                    <li  class="active">
                                        <label class="checkout-item pay-type" for="payment_5">支付宝</label>
                                        <input type="radio" name="pay_type" class="radio" id="payment_5" checked value="1"  isCod="0" />
                                        <div class="text">
                                            <i></i>手续费：0.00<em>元</em>
                                        </div>
                                    </li>
                                    <li>
                                        <label class="checkout-item pay-type" for="payment_5">微信</label>
                                        <input type="radio" name="pay_type" class="radio" id="payment_5" value="2"  isCod="0" />
                                        <div class="text">
                                            <i></i>手续费：0.00<em>元</em>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="section-options clearfix section-goods">
                            <div class="section-header clearfix" style="margin-bottom: 20px">
                                <h3 class="title" style="margin-bottom: 20px">商品列表</h3>
                            </div>
                            <table width="100%" align="center" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd" class="goods-list-table">
                                    <tr class="shop-list">
                                        <td bgcolor="#ffffff">
                                            <img src="{{$goods['sku_img']}}" title="{{$goods['goods_name']}}" width="30" height="30"/>
                                            <a href="home-goods-goodsInfo?goods_id={{$goods['goods_id']}}" target="_blank" class="f6">{{$goods['goods_name']}}&nbsp;{{$goods['sku_norms']}}
                                            </a>
                                        </td>
                                        <td bgcolor="#ffffff" align="center">{{$goods['sku_price']}}<em>元</em>&nbsp;x&nbsp;{{$num}}</td>
                                        <td bgcolor="#ffffff" align="center"><span class="shop_price" style="color:#ff6700;">{{$goods['sku_price']}}</span><em>元</em></td>
                                        <input type="hidden" name="sku_id" value="{{$goods['sku_id']}}">
                                        <input type="hidden" name="sku_sn" value="{{$goods['sku_sn']}}">
                                        <input type="hidden" name="goods_id" value="{{$goods['goods_id']}}">
                                        <input type="hidden" name="goods_name" value="{{$goods['goods_name']}}">
                                        <input type="hidden" name="sku_norms_value" value="{{$goods['sku_norms']}}">
                                        <input type="hidden" name="sku_img" value="{{$goods['sku_img']}}">
                                        <input type="hidden" name="sku_price" value="{{$goods['sku_price']}}">
                                        <input type="hidden" name="num" value="{{$num}}">
                                    </tr>
                                <tr>
                                    <td colspan="3" align="right" style="font-size: 18px;padding-right: 50px"bgcolor="#ffffff">
                                        小计：<span class="subtotal"style="font-size:24px;color: #FF6700" ></span><em>元</em>
                                    </td>
                                </tr>
                            </table>
                        </li>
                        <li class="section-options clearfix">
                            <h3 class="section-header">其它信息</h3>
                            <div class="section-body">
                            </div>
                        </li>
                        <li class="section-options clearfix">
                            <h3 class="section-header">订单附言</h3>
                            <div class="section-body">
                                <textarea name="postscript" cols="80" rows="3" id="postscript" style="border:1px solid #ccc;"></textarea>
                            </div>
                        </li>

                        <li class="section-options clearfix section-count">
                            <h3 class="section-header"><span>费用总计</span></h3>
                            <div id="ECS_ORDERTOTAL" class="money-box">
                                <ul>
                                    <li class="clearfix">
                                        <label>商品总价：</label><span class="val"></span>{{$goods['sku_price']}}<em>元</em>
                                    </li>
                                    <li class="clearfix">
                                        <label>配送费用：</label><em style="color: red"><em>元</em>
                                    </li>

                                    <li class="clearfix total-price">
                                        <label>应付款金额：</label> <span class="val"><em><em id="allprice">{{$goods['sku_price']}}</em><em>元</em></em></span>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <input type="hidden" name="address_name" value="">
                            <input type="hidden" name="address_tel" value="">
                            <input type="hidden" name="province" value="">
                            <input type="hidden" name="city" value="">
                            <input type="hidden" name="district" value="">
                            <input type="hidden" name="address" value="">
                            <input type="hidden" name="pack_price" value="">
                            <input type="hidden" name="order_price" value="">
                        </li>
                        <li class="section-options clearfix" style="border-bottom:none;">
                            <div style="margin:8px auto; text-align:right;">
                                <a href="javascript:;" id="submit"><img src="images/bnt_subOrder.gif" /></a>
                            </div>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="js/order.js"></script>
<!--脚部-->
@endsection
