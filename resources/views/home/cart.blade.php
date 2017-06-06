@extends('layouts.home-header')
     
@section('content')

    <link href="css/cart.css" rel="stylesheet" type="text/css" />
    <script> 
    var _token = "{{csrf_token()}}";
    </script>
    <script type="text/javascript" src="js/shopping_flow.js"></script>
    <script type="text/javascript" src="js/xiaomi_flow.js"></script>
    <script type="text/javascript" src="js/showdiv.js"></script>


<script type="text/javascript">
    var user_name_empty = "请输入您的用户名！";
    var email_address_empty = "请输入您的电子邮件地址！";
    var email_address_error = "您输入的电子邮件地址格式不正确！";
    var new_password_empty = "请输入您的新密码！";
    var confirm_password_empty = "请输入您的确认密码！";
    var both_password_error = "您两次输入的密码不一致！";
    var show_div_text = "请点击更新购物车按钮";
    var show_div_exit = "关闭";
</script>

<div class="page-main" id="cart-box">
    <div class="container">
        <div class="cart-goods-list">
            <div class="list-head clearfix">
                <div class="col col-img" id="itemsnum-top">图片</div>
                <div class="col col-name">商品名称</div>
                <div class="col col-price">单价</div>
                <div class="col col-num">数量</div>
                <div class="col col-total">小计</div>
                <div class="col col-action">操作</div>
            </div>
            <div class="list-body">
            @if (empty($data))
                <p>购物车空空如也<a href="{{URL::to('/')}}">去逛逛吧</a></p>
            @else
            @foreach ($data as $k=>$v)           
                <div class="item-box">
                    <div class="item-table">
                        <div class="item-row clearfix">
                            <div class="col col-img"> <a href="home-goods-goodsInfo?goods_id={{$v['goods_id']}}" target="_blank"> <img alt="{{$v['goods_name']}}" src="{{$v['sku_img']}}"></a> </div>
                            <div class="col col-name">
                                <h3 class="name"><a href="home-goods-goodsInfo?goods_id={{$v['goods_id']}}" target="_blank">{{$v['goods_name']}}</a></h3>
                                <p class="desc"><span>{{$v['sku_norms']}}</span></a>
                                </p>
                            </div>

                            <div class="col col-price">
                               {{$v['sku_price']}}<em>元</em>
                            </div>
                            <div class="col col-num">
                                <div class="change-goods-num clearfix">
                                    <a href="javascript:void(0)" class="minus" title="减少1个数量" onclick="flowClickCartNum({{$v['sku_id']}}, -1);" ><i class="iconfont"></i></a>
                                    <input type="text" id="goods_number_{{$v['sku_id']}}" value="{{$v['num']}}"  onchange="flowClickCartNum({{$v['sku_id']}}, 0)">
                                    <a href="javascript:void(0)" class="add" title="增加1个数量" onclick="flowClickCartNum({{$v['sku_id']}}, +1);"><i class="iconfont"></i></a>
                                </div>
                            </div>
                            <div class="col col-total"><span id="total_items_{{$v['sku_id']}}">{{$v['num_price']}}<em>元</em></span></div>
                            <div class="col col-action">
                                <a class="del" href="javascript:if (confirm('您确实要把该商品移出购物车吗？')) location.href='home-cart-delOne?sku_id={{$v['sku_id']}}';"><i class="iconfont"></i></a>
                            </div>
                        </div>
                    </div>
                </div> 
            @endforeach
            @endif
            </div>
            <p class="clear-cart"> <a id="del-all" href="home-cart-delOne?sku_id=all">清空购物车</a> </p>

            <div class="cart-bar clearfix">
                <div class="section-left">
                    <a class="back-shopping btn btn-gray" href="{{URL::to('/')}}">继续购物</a>
                </div>
                <span class="total-price"><span class="total-num"></span>&nbsp;&nbsp;&nbsp;合计：<b id="totalSkuPrice">{{$total_price}}<em>元</em></b></span>
                <a href="flow.php?step=checkout" class="btn btn-pay btn-primary">去结算</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" charset="utf-8">
    function collect_to_flow(goodsId)
    {
        var goods        = new Object();
        var spec_arr     = new Array();
        var fittings_arr = new Array();
        var number       = 1;
        goods.spec     = spec_arr;
        goods.goods_id = goodsId;
        goods.number   = number;
        goods.parent   = 0;
        Ajax.call('flow.php?step=add_to_cart', 'goods=' + goods.toJSONString(), collect_to_flow_response, 'POST', 'JSON');
    }
    function collect_to_flow_response(result)
    {
        if (result.error > 0)
        {
            // 如果需要缺货登记，跳转
            if (result.error == 2)
            {
                if (confirm(result.message))
                {
                    location.href = 'user.php?act=add_booking&id=' + result.goods_id;
                }
            }
            else if (result.error == 6)
            {
                openSpeDiv(result.message, result.goods_id);
            }
            else
            {
                alert(result.message);
            }
        }
        else
        {
            location.href = 'flow.php';
        }
    }
</script>
<div class="blank"></div>


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