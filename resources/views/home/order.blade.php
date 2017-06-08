@extends('layouts.home-header')

@section('content')
    <link href="css/cart.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/common.js"></script>
    <script type="text/javascript" src="js/shopping_flow.js"></script>
    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.json.js"></script>
    <script type="text/javascript" src="js/transport_jquery.js"></script>
    <script type="text/javascript" src="js/utils.js"></script>
    <script type="text/javascript" src="js/jquery.SuperSlide.js"></script>
    <script type="text/javascript" src="js/xiaomi_common.js"></script>
    <script type="text/javascript" src="js/xiaomi_flow.js"></script>
    <script type="text/javascript" src="js/parsonal/userAddress.js"></script>
<body>

<div class="page-main">
    <div class="container clearfix">
        <div class="checkout-box confirm-order-box">
            <h2>确认订单信息页面</h2>
            <div class="flowBox_in">
                <form action="home-order-finsh" method="post" name="theForm" id="theForm">
                    {{ csrf_field() }}
                    <script type="text/javascript">
                        var flow_no_payment = "您必须选定一个支付方式。";
                        var flow_no_shipping = "您必须选定一个配送方式。";
                    </script>
                    <input type="hidden" name="type" value="{{$type}}">
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
                            详细地址：<input type="text" name="" id="address">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <button class="addUserAddress" style="width: 50px">确定</button>
                        </li>
                        <li class="section-options clearfix">
                            <h3 class="section-header"><span>支付方式</span></h3>
                            <div class="section-body">
                                <ul class="item-list clearfix payment-list" id="payment-list">
                                    @if($type != 'integral')
                                    <li>
                                        <label class="checkout-item pay-type" for="payment_2">余额支付</label>
                                        <input type="radio" name="pay_type" class="radio" id="payment_2" value="3"  isCod="0" />
                                        <div class="text">
                                            <i></i>手续费：0.00<em>元</em>
                                        </div>
                                    </li>

                                    <li>
                                        <label class="checkout-item pay-type" for="payment_4">货到付款</label>
                                        <input type="radio" name="pay_type" class="radio" id="payment_4" value="4"  isCod="1" disabled="true"/>
                                        <div class="text">
                                            <i></i>手续费：<span id="ECS_CODFEE">0.00<em>元</em></span>                        </div>
                                    </li>

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
                                    @else
                                    <li>
                                        <label class="checkout-item pay-type" for="payment_5">积分</label>
                                        <input type="radio" name="pay_type" class="radio" checked id="payment_5" value="5"  isCod="0" />
                                        <div class="text">
                                            <i></i>手续费：0.00<em>元</em>
                                        </div>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </li>
                        <li class="section-options clearfix section-shipping">
                            <h3 class="section-header"><span>配送方式</span></h3>
                            <div class="section-body">
                                <ul class="item-list clearfix payment-list" id="shipping-list">
                                    @if($type != 'integral')
                                    <li>
                                        <label class="checkout-item logistics-price" for="ECS_NEEDINSURE_1">申通快递</label>
                                        <input name="logistics_price" type="radio" value="15.00"  supportCod="0" insure="0" class="radio" />
                                        <div class="text">
                                            <i></i>费用：15.00<em>元</em>&nbsp;&nbsp;免费额度：0.00<em>元</em>                    </div>
                                    </li>
                                    <li>
                                        <label class="checkout-item logistics-price" for="ECS_NEEDINSURE_2">顺丰快递</label>
                                        <input name="logistics_price" type="radio" value="20.00"  supportCod="1" insure="0" class="radio" />
                                        <div class="text">
                                            <i></i>费用：20.00<em>元</em>&nbsp;&nbsp;免费额度：0.00<em>元</em>                    </div>
                                    </li>
                                    <li>
                                        <label class="checkout-item logistics-price" for="ECS_NEEDINSURE_3">圆通快递</label>
                                        <input name="logistics_price" type="radio" value="15.00"  supportCod="0" insure="0" class="radio" />
                                        <div class="text">
                                            <i></i>费用：15.00<em>元</em>&nbsp;&nbsp;免费额度：0.00<em>元</em>                    </div>
                                    </li>
                                    <li class="active">
                                        <label class="checkout-item logistics-price" for="ECS_NEEDINSURE_4">中通速递</label>
                                        <input name="logistics_price" type="radio" value="0"  checked supportCod="0" insure="1%" class="radio" />
                                        <div class="text">
                                            <i></i>费用：0.00<em>元</em>&nbsp;&nbsp;免邮费</em>                    </div>
                                    </li>
                                    @else
                                        <li>
                                            <label class="checkout-item logistics-price" for="ECS_NEEDINSURE_1">申通快递</label>
                                            <input name="logistics_price" type="radio" value="0"  supportCod="0" insure="0" class="radio" />
                                            <div class="text">
                                                <i></i>费用：0.00<em>元</em>&nbsp;&nbsp;免邮费                    </div>
                                        </li>
                                        <li>
                                            <label class="checkout-item logistics-price" for="ECS_NEEDINSURE_2">顺丰快递</label>
                                            <input name="logistics_price" type="radio" value="0"  supportCod="1" insure="0" class="radio" />
                                            <div class="text">
                                                <i></i>费用：0.00<em>元</em>&nbsp;&nbsp;免邮费                    </div>
                                        </li>
                                        <li>
                                            <label class="checkout-item logistics-price" for="ECS_NEEDINSURE_3">圆通快递</label>
                                            <input name="logistics_price" type="radio" value="0"  supportCod="0" insure="0" class="radio" />
                                            <div class="text">
                                                <i></i>费用：0.00<em>元</em>&nbsp;&nbsp;免邮费                    </div>
                                        </li>
                                        <li class="active">
                                            <label class="checkout-item logistics-price" for="ECS_NEEDINSURE_4">中通速递</label>
                                            <input name="logistics_price" type="radio" value="0"  checked supportCod="0" insure="1%" class="radio" />
                                            <div class="text">
                                                <i></i>费用：0.00<em>元</em>&nbsp;&nbsp;免邮费                   </div>
                                        </li>
                                    @endif

                                </ul>
                            </div>
                        </li>

                        <li class="section-options clearfix section-goods">
                            <div class="section-header clearfix">
                                <h3 class="title">商品列表</h3>
                                @if ($type == 'cart')
                                <a href="flow.php" class="modify">返回购物车<i class="iconfont"></i></a>
                                @endif
                            </div>
                            <table width="100%" align="center" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd" class="goods-list-table">
                                @foreach ($goods as $k => $val)
                                    <tr class="shop-list">
                                        <td bgcolor="#ffffff">
                                            <img src="{{$val['sku_img']}}" title="{{$val['goods_name']}}" width="30" height="30"/>
                                            <a href="home-goods-goodsInfo?goods_id={{$val['goods_id']}}" target="_blank" class="f6">{{$val['goods_name']}}&nbsp;{{$val['sku_norms']}}
                                            </a>
                                        </td>
                                        <td bgcolor="#ffffff" align="center">{{$val['sku_price']}}<em>@if($type != 'integral')元@else分@endif</em>&nbsp;x&nbsp;{{$num[$k]}}</td>
                                        <td bgcolor="#ffffff" align="center"><span class="shop_price" style="color:#ff6700;">{{$val['sku_price'] * $num[$k]}}</span><em>@if($type != 'integral')元@else分@endif</em></td>
                                        <input type="hidden" name="type" value="{{$type}}">
                                        <input type="hidden" name="sku_id[]" value="{{$val['sku_id']}}">
                                        <input type="hidden" name="sku_sn[]" value="{{$val['sku_sn']}}">
                                        <input type="hidden" name="goods_id[]" value="{{$val['goods_id']}}">
                                        <input type="hidden" name="goods_name[]" value="{{$val['goods_name']}}">
                                        <input type="hidden" name="sku_norms_value[]" value="{{$val['sku_norms']}}">
                                        <input type="hidden" name="sku_img[]" value="{{$val['sku_img']}}">
                                        <input type="hidden" name="sku_price[]" value="{{$val['sku_price']}}">
                                        <input type="hidden" name="num[]" value="{{$num[$k]}}">
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" align="right" style="font-size: 18px;padding-right: 50px"bgcolor="#ffffff">
                                        小计：<span class="subtotal"style="font-size:24px;color: #FF6700" ></span><em>@if($type != 'integral')元@else分@endif</em>
                                    </td>
                                </tr>
                            </table>
                        </li>
                        <li class="section-options clearfix">
                            <h3 class="section-header">其它信息</h3>
                        </li>
                        @if($type != 'integral')
                        <li class="section-options clearfix">
                            <h3 class="section-header">使用红包</h3>
                            <div class="section-body">
                                <span class="item">
                                    选择已有红包
                                    <select name="pack_id" id="ECS_BONUS" style="border:1px solid #ccc;">
                                        <option value=""  low_use_price="" selected>请选择</option>
                                        @foreach ($package as $val)
                                            <option value="{{$val['pack_id']}}" low_use_price="{{$val['low_use_price']}}">{{$val['pack_price']}}</option>
                                        @endforeach
                                    </select>
                                    该红包价格为  <span id="pack_price" style="font-size:20px;color: limegreen; ">0.00</span><em>元</em>，使用最低订单价为  <span id="low_use_price" style="font-size:20px;color: red; ">0.00</span><em>元</em>
                                </span>
                            </div>
                        </li>
                        @endif
                        <li class="section-options clearfix">
                            <h3 class="section-header">订单附言</h3>
                            <div class="section-body">
                                <textarea name="postscript" cols="80" rows="3" id="postscript" style="border:1px solid #ccc;"></textarea>
                            </div>
                        </li>

                        <li class="section-options clearfix section-count">
                            <!--<h3 class="section-header"><span>费用总计</span></h3>-->
                            <div id="ECS_ORDERTOTAL" class="money-box">
                                <ul>
                                    @if($type != 'integral')
                                    <li class="clearfix">
                                        <label>订购即送：</label>
                                        <span class="val">
                                        <font class="f4_b"></font> 积分
                                        </span>
                                    </li>
                                    <li class="clearfix">
                                        <label>商品总价：</label><span class="val"></span><em>元</em>
                                    </li>
                                    <li class="clearfix">
                                        <label>配送费用：</label><em style="color: red">+</em> <span class="val">0.00</span><em>元</em>
                                    </li>
                                    <li class="clearfix" style="display:none;">
                                        <label>红包：</label><em style="color: red">-</em> <span class="val">20.00</span><em>元</em>
                                    </li>
                                    <li class="clearfix total-price">
                                        <label>应付款金额：</label> <span class="val"><em><em id="allprice"></em><em>元</em></em></span>
                                    </li>
                                    @else
                                    <li class="clearfix total-price">
                                        <label>应付积分：</label> <span class="val"><em><em id="allprice"></em><em>分</em></em></span>
                                    </li>
                                    @endif
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
                            <input type="hidden" name="logistics_type" value="中通快递">
                            <input type="hidden" name="pack_price" value="">
                            <input type="hidden" name="order_price" value="">
                            <input type="hidden" name="get_point" value="">
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
