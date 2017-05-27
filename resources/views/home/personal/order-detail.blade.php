@extends('layouts.home-header')

@section('content')
<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/user.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/user.js"></script>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/transport_jquery.js"></script>
<script type="text/javascript" src="js/jquery.SuperSlide.js"></script>
<script type="text/javascript" src="js/xiaomi_common.js"></script>
<body class="user_center">
<div class="breadcrumbs">
    <div class="container">
        <a href=".">首页</a>
        <code>&gt;</code> 用户中心
    </div>
</div>
<div class="xm-bg">
    <div id="wrapper" class="container">
        <div class="my_nala_main">
            @include('/home/personal/left')
            <div class="my_nala_centre ilizi_centre">
                <div class="ilizi cle">
                    <div class="box">
                        <div class="box_1">
                            <div class="userCenterBox boxCenterList clearfix" style="_height:1%;">
                                <h1>订单状态</h1>
                                <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                                    <tbody>
                                    <tr>
                                        <td width="15%" align="right" bgcolor="#ffffff">订单号：</td>
                                        <td align="left" bgcolor="#ffffff">{{ $userOrder['order_sn'] }}</td>
                                    </tr>
                                    <tr>
                                        <td align="right" bgcolor="#ffffff">订单状态：</td>
                                        <td align="left" bgcolor="#ffffff">@if ($userOrder['status'] == 1) 未支付   <input
                                                    type="button" style="margin-left: 50px" value="立即使用支付宝支付" > @elseif ($userOrder['status'] == 2) 已支付 @elseif ($userOrder['status'] == 3) 已出库 @elseif ($userOrder['status'] == 4) 已收货 @endif</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <h1>商品列表 </h1>
                                <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                                    <tbody>
                                    <tr>
                                        <th width="23%" align="center" bgcolor="#ffffff">商品名称</th>
                                        <th width="29%" align="center" bgcolor="#ffffff">属性</th>
                                        <!--<th>专柜价</th>-->
                                        <th width="26%" align="center" bgcolor="#ffffff">商品价格</th>
                                        <th width="9%" align="center" bgcolor="#ffffff">购买数量</th>
                                        <th width="20%" align="center" bgcolor="#ffffff">小计</th>
                                    </tr>
                                    @foreach ($orderGoods as $val)
                                    <tr>
                                        <td bgcolor="#ffffff"> <a href="goods.php?id=80" target="_blank" class="f6">{{ $val['goods_name'] }}</a> </td>
                                        <td align="left" bgcolor="#ffffff">{{ $val['sku_norms_value'] }}</td>
                                        <td align="right" bgcolor="#ffffff">{{ $val['sku_price'] }}<em>元</em></td>
                                        <td align="center" bgcolor="#ffffff">{{ $val['num'] }}</td>
                                        <td align="right" bgcolor="#ffffff">{{ $val['sku_price']*$val['num'] }}<em>元</em></td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="8" bgcolor="#ffffff" align="right"> 商品总价: {{ $userOrder['order_price'] }}<em>元</em> </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <h1>费用总计</h1>
                                <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                                    <tbody>
                                    <tr>
                                        <td align="right" bgcolor="#ffffff"> 商品总价: {{ $userOrder['order_price'] }}<em>元</em> + 配送费用: {{ $userOrder['logistics_price'] }}<em>元</em> </td>
                                    </tr>
                                    <tr>
                                        <td align="right" bgcolor="#ffffff"> </td>
                                    </tr>
                                    <tr>
                                        <td align="right" bgcolor="#ffffff">应付款金额: {{ $userOrder['order_price']+$userOrder['logistics_price'] }}<em>元</em> </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <h1>收货人信息</h1>
                                <form action="" method="post" name="formAddress" onsubmit="return false" id="formAddress">
                                    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                                        <tbody>
                                        <tr>
                                            <td align="right" bgcolor="#ffffff">收货人姓名：</td>
                                            <td align="left" bgcolor="#ffffff">@if ($userOrder['status'] < 2)<input name="consignee" type="text" class="inputBg address_name" id="consignee_0" value="{{ $userOrder['consignee_name'] }}" />@else{{ $userOrder['consignee_name'] }}@endif
                                                (必填) </td>
                                            <td align="right" bgcolor="#ffffff">电话：</td>
                                            <td align="left" bgcolor="#ffffff">@if ($userOrder['status'] < 2)<input name="tel" type="text" class="inputBg address_tel" id="tel_0" value="{{ $userOrder['consignee_tel'] }}" />@else{{ $userOrder['consignee_tel'] }}@endif
                                                (必填)</td>
                                        </tr>
                                        <tr>
                                            <td align="right" bgcolor="#ffffff">详细地址：</td>
                                            <td align="left" bgcolor="#ffffff">@if ($userOrder['status'] < 2)<input name="address" type="text" class="inputBg address" id="address_0" value="{{ $userOrder['consignee_address'] }}" />@else{{ $userOrder['consignee_address'] }}@endif
                                                (必填)</td>
                                            <td align="right" bgcolor="#ffffff"></td>
                                            <td align="left" bgcolor="#ffffff"></td>
                                        </tr>
                                        @if ($userOrder['status'] < 2)
                                        <tr>
                                            <td colspan="4" align="center" bgcolor="#ffffff"><input type="submit" order_id = "{{ $userOrder['order_id'] }}" class="btn btn-primary update" value="更新收货人信息" /> </td>
                                        </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </form>
                                <h1>支付方式</h1>
                                <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                                    <tbody>
                                    <tr>
                                        <td bgcolor="#ffffff"> 所选支付方式: 支付宝。应付款金额: <strong>{{ $userOrder['order_price']+$userOrder['logistics_price'] }}<em>元</em></strong><br /> 支付宝网站(www.alipay.com) 是国内先进的网上支付平台。<br />支付宝收款接口：在线即可开通，<font color="red"><b>零预付，免年费</b></font>，单笔阶梯费率，无流量限制。<br /><a href="http://cloud.ecshop.com/payment_apply.php?mod=alipay" target="_blank"><font color="red">立即在线申请</font></a> </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <h1>其它信息</h1>
                                <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                                    <tbody>
                                    <tr>
                                        <td width="15%" align="right" bgcolor="#ffffff">配送方式：</td>
                                        <td colspan="3" width="85%" align="left" bgcolor="#ffffff">{{ $userOrder['logistics_type'] }}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" align="right" bgcolor="#ffffff">支付方式：</td>
                                        <td colspan="3" align="left" bgcolor="#ffffff">支付宝</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" align="right" bgcolor="#ffffff">缺货处理：</td>
                                        <td colspan="3" align="left" bgcolor="#ffffff">等待所有商品备齐后再发</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click','.update',function () {
        var consignee_name = $('.address_name').val();
        var oldconsignee_name = $('.address_name').attr('value');
        var consignee_tel = $('.address_tel').val();
        var oldconsignee_tel = $('.address_tel').attr('value');
        var consignee_address = $('.address').val();
        var oldconsignee_address = $('.address').attr('value');
        var order_id = $(this).attr('order_id');
        if (consignee_name == oldconsignee_name && consignee_address == consignee_address && consignee_tel == oldconsignee_tel) {
            alert('您未进行任何修改');
            return false;
        }
        $.ajax({
            type:'post',
            url:"home-personal-updateOrder",
            data:{_token:"{{csrf_token()}}",order_id:order_id,consignee_name:consignee_name,consignee_tel:consignee_tel,consignee_address:consignee_address},
            dataType:'json',
            success:function (data) {
                alert(data['msg'])
            }
        })
    })
</script>
@endsection