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
                                        <input type="radio" name="pay_type" class="radio" id="payment_5" value="1"  isCod="0" />
                                        <div class="text">
                                            <i></i>手续费：0.00<em>元</em>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li class="section-options clearfix section-shipping">
                            <h3 class="section-header"><span>配送方式</span></h3>
                            <div class="section-body">
                                <ul class="item-list clearfix payment-list" id="shipping-list">
                                    <li>
                                        <label class="checkout-item logistics-price" for="ECS_NEEDINSURE_1">申通快递</label>
                                        <input name="logistics_price" type="radio" value="15.00"  supportCod="0" insure="0" class="radio" />
                                        <div class="text">
                                            <i></i>费用：15.00<em>元</em>&nbsp;&nbsp;免费额度：0.00<em>元</em>                    </div>
                                    </li>
                                    <li class="active">
                                        <label class="checkout-item logistics-price" for="ECS_NEEDINSURE_2">顺丰快递</label>
                                        <input name="logistics_price" type="radio" value="20.00" checked  supportCod="1" insure="0" class="radio" />
                                        <div class="text">
                                            <i></i>费用：20.00<em>元</em>&nbsp;&nbsp;免费额度：0.00<em>元</em>                    </div>
                                    </li>
                                    <li>
                                        <label class="checkout-item logistics-price" for="ECS_NEEDINSURE_3">圆通快递</label>
                                        <input name="logistics_price" type="radio" value="15.00"  supportCod="0" insure="0" class="radio" />
                                        <div class="text">
                                            <i></i>费用：15.00<em>元</em>&nbsp;&nbsp;免费额度：0.00<em>元</em>                    </div>
                                    </li>
                                    <li>
                                        <label class="checkout-item logistics-price" for="ECS_NEEDINSURE_4">中通速递</label>
                                        <input name="logistics_price" type="radio" value="10"  supportCod="0" insure="1%" class="radio" />
                                        <div class="text">
                                            <i></i>费用：10.00<em>元</em>&nbsp;&nbsp;免费额度：0.00<em>元</em>                    </div>
                                    </li>
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
                                @if ($type == 'direct')
                                <tr class="shop-list">
                                    <td bgcolor="#ffffff">
                                        <img src="{{$goods['sku_img']}}" title="{{$goods['goods_name']}}" width="30" height="30"/>
                                        <a href="home-goods-goodsInfo?goods_id={{$goods['goods_id']}}" target="_blank" class="f6">{{$goods['goods_name']}}&nbsp;{{$goods['sku_norms']}}
                                        </a>
                                    </td>
                                    <td bgcolor="#ffffff" align="center">{{$goods['sku_price']}}<em>元</em>&nbsp;x&nbsp;{{$num}}</td>
                                    <td bgcolor="#ffffff" align="center"><span class="shop_price" style="color:#ff6700;">{{$goods['sku_price']*$num}}</span><em>元</em></td>
                                    <input type="hidden" name="sku_id" value="{{$goods['sku_id']}}">
                                    <input type="hidden" name="sku_sn" value="{{$goods['sku_sn']}}">
                                    <input type="hidden" name="goods_id" value="{{$goods['goods_id']}}">
                                    <input type="hidden" name="goods_name" value="{{$goods['goods_name']}}">
                                    <input type="hidden" name="sku_norms_value" value="{{$goods['sku_norms']}}">
                                    <input type="hidden" name="sku_img" value="{{$goods['sku_img']}}">
                                    <input type="hidden" name="sku_price" value="{{$goods['sku_price']}}">
                                    <input type="hidden" name="num" value="{{$num}}">
                                </tr>
                                @elseif ($type == 'cart')

                                @endif
                                <tr>
                                    <td colspan="3" align="right" style="font-size: 18px;padding-right: 50px"bgcolor="#ffffff">
                                        小计：<span class="subtotal"style="font-size:24px;color: #FF6700" ></span><em>元</em>
                                    </td>
                                </tr>
                            </table>
                        </li>
                        <li class="section-options clearfix">
                            <h3 class="section-header">其它信息</h3>
                        </li>

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
                                    <li class="clearfix">
                                        <label>订购即送：</label>
                                        <span class="val">
                                        <font class="f4_b">1098</font> 积分
                                    </span>
                                    </li>
                                    <li class="clearfix">
                                        <label>商品总价：</label><span class="val"></span><em>元</em>
                                    </li>
                                    <li class="clearfix">
                                        <label>配送费用：</label><em style="color: red">+</em> <span class="val">20.00</span><em>元</em>
                                    </li>
                                    <li class="clearfix" style="display:none;">
                                        <label>红包：</label><em style="color: red">-</em> <span class="val">20.00</span><em>元</em>
                                    </li>
                                    <li class="clearfix total-price">
                                        <label>应付款金额：</label> <span class="val"><em><em id="allprice"></em><em>元</em></em></span>
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
                            <input type="hidden" name="logistics_type" value="顺丰快递">
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
<script>
    $(document).ready(function () {
        var subtotal = '';
        for (var i=0;i<$('.shop-list').length;i++) {
            subtotal += $('.shop-list').eq(i).children('td').eq(2).children('.shop_price').html();
        }
        $('.subtotal').html(subtotal);
        $('.money-box').children('ul').children('li').eq(1).children("span").html(subtotal);
        var due = parseFloat(subtotal) + 20.00;
        $('#allprice').html(due);
        $('#ECS_BONUS').val('0');
        $('.money-box').children('ul').children('li').eq(3).children("span").html('0.00');
        $("input[name='pack_price']").val('0.00');
        for (var j=0;j<$("input[name='userAddress']").length;j++) {
            if ($("input[name='userAddress']").eq(j).prop('checked') == true) {
                var obj = $("input[name='userAddress']").eq(j);
                var address_name = obj.parents('div').children('.addr-name').html();
                var address_tel = obj.parents('div').children('.addr-tel').html();
                var addrInfo = obj.parents('div').children('.addr-info').html();
                var addrInfo = addrInfo.split(" ");
                $("input[name='address_name']").val(address_name);
                $("input[name='address_tel']").val(address_tel);
                $("input[name='province']").val(addrInfo[0]);
                $("input[name='city']").val(addrInfo[1]);
                $("input[name='district']").val(addrInfo[2]);
                $("input[name='address']").val(addrInfo[3]);
            }
        }

    })
    $(document).on('click','#shipping-list li',function () {
        var obj = $(this);
        var shipping_money = obj.children("input[name='logistics_price']").val();
        var subtotal = $('.money-box').children('ul').children('li').eq(1).children("span").html();
        var pack_price = $('.money-box').children('ul').children('li').eq(3).children("span").html();
        var due = parseFloat(shipping_money)+parseFloat(subtotal)-parseFloat(pack_price);
        $('.money-box').children('ul').children('li').eq(2).children("span").html(shipping_money);
        $('#allprice').html(due);
        $("input[name='pack_price']").val(pack_price);
        $("input[name='order_price']").val(due);
    })
    $(document).on('change','#ECS_BONUS',function () {
        var ECS_BONUS = $(this).val();
        var pack_price = $(this).children('option:selected').html();
        var low_use_price = $(this).children('option:selected').attr('low_use_price');
        var pack = $('.money-box').children('ul').children('li').eq(3).children("span").html();
        if (ECS_BONUS == '') {
            $('.money-box').children('ul').children('li').eq(3).css("display","none");
            $('.money-box').children('ul').children('li').eq(3).children("span").html('0.00');
        } else {
            $('.money-box').children('ul').children('li').eq(3).css("display","block");
            $('.money-box').children('ul').children('li').eq(3).children("span").html(pack_price);
        }
        if (pack_price == '请选择') {
            pack_price = '0.00';
        }
        if (low_use_price == '') {
            low_use_price = '0.00';
        }
        $('#pack_price').html(pack_price);
        $('#low_use_price').html(low_use_price);
        var allprice = $('#allprice').html();
        allprice = parseFloat(allprice)+parseFloat(pack)-parseFloat(pack_price);
        $('#allprice').html(allprice);
        $("input[name='pack_price']").val(pack_price);
        $("input[name='order_price']").val(allprice);
    })
    $(document).on('click',"input[name='userAddress']",function () {
        var address_name = $(this).parents('div').children('.addr-name').html();
        var address_tel = $(this).parents('div').children('.addr-tel').html();
        var addrInfo = $(this).parents('div').children('.addr-info').html();
        var addrInfo = addrInfo.split(" ");
        $("input[name='address_name']").val(address_name);
        $("input[name='address_tel']").val(address_tel);
        $("input[name='province']").val(addrInfo[0]);
        $("input[name='city']").val(addrInfo[1]);
        $("input[name='district']").val(addrInfo[2]);
        $("input[name='address']").val(addrInfo[3]);
    })
    $(document).on('click','.logistics-price',function () {
        $(this).next('input[name="logistics_price"]').attr('checked',true);
        $("input[name='logistics_type']").val($(this).html());
    })
    $(document).on('click','.pay-type',function () {
        $(this).next('input[name="pay_type"]').attr('checked',true);
    })
    $(document).on('click','#submit',function () {
        var low_use_price = $('#low_use_price').html();
        var allprice = $('#allprice').html();
        var pack_price =  $("input[name='pack_price']").val();
        if (parseFloat(allprice)+parseFloat(pack_price) < parseFloat(low_use_price)) {
            alert('该订单不能使用该红包！')
            return false;
        }
        $('#theForm').submit();
    })
</script>
<!--脚部-->
<script type="text/javascript" src="js/parsonal/userAddress.js"></script>
@endsection
