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


<div class="xm-bg">
    <div class="page_main">
        <div class="container" style="background:#fff;">
            <div class="section section-order">
                <div class="order-info clearfix">
                    <div class="fl">
                        <h2 class="title">感谢您在本店购物！您的订单已提交成功，请记住您的订单号 <b>2017051952016</b></h2>
                    </div>
                    <div class="fr">
                        <p class="total">您的应付款金额为 <span class="money"><em>84.00<em>元</em></em></span></p>
                    </div>
                </div>
                <i class="iconfont icon-right">√</i>
                <div class="order-detail">
                    <ul>
                        <li class="clearfix">
                            <div class="label">订单号:</div>
                            <div class="content"><div class="order-num">2017051952016</div></div>
                        </li>
                        <li class="clearfix">
                            <div class="label">您选定的配送方式为:</div><div class="content">申通快递</div>
                        </li>
                        <li class="clearfix">
                            <div class="label">您选定的支付方式为:</div><div class="content">支付宝</div>
                        </li>
                        <li class="clearfix">
                            <div class="label">您的应付款金额为:</div><div class="content money"><em>84.00<em>元</em></em></div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="section section-payment">
                <div class="pay_action"><div style="text-align:center"><input type="button" onclick="window.open('https://mapi.alipay.com/gateway.do?_input_charset=utf-8&extend_param=isv%5Esh22&logistics_fee=0&logistics_payment=BUYER_PAY_AFTER_RECEIVE&logistics_type=EXPRESS&notify_url=http%3A%2F%2Fwww.zhudi.com%2Fmishop%2Frespond.php%3Fcode%3Dalipay&out_trade_no=2017051952016127&partner=2088801949323430&payment_type=1&price=84.00&quantity=1&return_url=http%3A%2F%2Fwww.zhudi.com%2Fmishop%2Frespond.php%3Fcode%3Dalipay&seller_email=xctxpcom%40126.com&service=create_direct_pay_by_user&subject=2017051952016&sign=263e501e795595179b4ab01b14de896f&sign_type=MD5')" value="立即使用支付宝支付" /></div></div>
            </div>

            <p style="text-align:center; margin-bottom:36px;">您可以 <a href="index.php">返回首页</a> 或去 <a href="user.php">用户中心</a></p>
        </div>
    </div>
</div>

<script type="text/javascript">
    var process_request = "正在处理您的请求...";
    var username_empty = "用户名不能为空。";
    var username_shorter = "用户名长度不能少于 3 个字符。";
    var username_invalid = "用户名只能是由字母数字以及下划线组成。";
    var password_empty = "登录密码不能为空。";
    var password_shorter = "登录密码不能少于 6 个字符。";
    var confirm_password_invalid = "两次输入密码不一致";
    var email_empty = "Email 为空";
    var email_invalid = "Email 不是合法的地址";
    var agreement = "您没有接受协议";
    var msn_invalid = "msn地址不是一个有效的邮件地址";
    var qq_invalid = "QQ号码不是一个有效的号码";
    var home_phone_invalid = "家庭电话不是一个有效号码";
    var office_phone_invalid = "办公电话不是一个有效号码";
    var mobile_phone_invalid = "手机号码不是一个有效号码";
    var msg_un_blank = "用户名不能为空";
    var msg_un_length = "用户名最长不得超过7个汉字";
    var msg_un_format = "用户名含有非法字符";
    var msg_un_registered = "用户名已经存在,请重新输入";
    var msg_can_rg = "可以注册";
    var msg_email_blank = "邮件地址不能为空";
    var msg_email_registered = "邮箱已存在,请重新输入";
    var msg_email_format = "邮件地址不合法";
    var msg_blank = "不能为空";
    var no_select_question = "您没有完成密码提示问题的操作";
    var passwd_balnk = "- 密码中不能包含空格";
    var username_exist = "用户名 %s 已经存在";
    var compare_no_goods = "您没有选定任何需要比较的商品或者比较的商品数少于 2 个。";
    var btn_buy = "购买";
    var is_cancel = "取消";
    var select_spe = "请选择商品属性";
</script>


<!--脚部-->
@endsection

