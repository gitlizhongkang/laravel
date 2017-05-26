<?php  
$user_id = Session::get('uid');
$user_name = Session::get('name');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>商城</title>
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="icon" href="animated_favicon.gif" type="image/gif" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/goods.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="js/common.js"></script>
    <script type="text/javascript">
    function $id(element) {
        return document.getElementById(element);
    }
    //切屏--是按钮，_v是内容平台，_h是内容库
    function reg(str){
        var bt=$id(str+"_b").getElementsByTagName("h2");
        for(var i=0;i<bt.length;i++){
            bt[i].subj=str;
            bt[i].pai=i;
            bt[i].style.cursor="pointer";
            bt[i].onclick=function(){
                $id(this.subj+"_v").innerHTML=$id(this.subj+"_h").getElementsByTagName("blockquote")[this.pai].innerHTML;
                for(var j=0;j<$id(this.subj+"_b").getElementsByTagName("h2").length;j++){
                    var _bt=$id(this.subj+"_b").getElementsByTagName("h2")[j];
                    var ison=j==this.pai;
                    _bt.className=(ison?"":"h2bg");
                }
            }
        }
        $id(str+"_h").className="none";
        $id(str+"_v").innerHTML=$id(str+"_h").getElementsByTagName("blockquote")[0].innerHTML;
    }
</script>

    <script type="text/javascript" src="js/jquery.json.js"></script>
    <script type="text/javascript" src="js/transport_jquery.js"></script>
    <script type="text/javascript" src="js/utils.js"></script>
    <script type="text/javascript" src="js/jquery.SuperSlide.js"></script>
    <script type="text/javascript" src="js/xiaomi_common.js"></script>
    <script type="text/javascript">
        function checkSearchForm()
        {
            if(document.getElementById('keyword').value)
            {
                return true;
            }
            else
            {
                alert("请输入搜索关键词！");
                return false;
            }
        }
    </script>
    <script type="text/javascript" src="js/magiczoomplus.js"></script>
    <script type="text/javascript" src="js/easydialog.min.js"></script>
    <script type="text/javascript" src="js/xiaomi_goods.js"></script>
</head>
<body>

<div class="site-topbar">
    <div class="container">
        <div class="topbar-cart" id="ECS_CARTINFO">
            <a class="cart-mini " href="flow.php">
                <i class="iconfont">&#xe60c;</i>购物车
                <span class="mini-cart-num J_cartNum" id="hd_cartnum">(0)</span>
            </a>
            <div id="J_miniCartList" class="cart-menu">
                <p class="loading">购物车中还没有商品，赶紧选购吧！</p>
            </div>
            <script type="text/javascript">

                function deleteCartGoods(rec_id) {
                    Ajax.call('delete_cart_goods.php', 'id=' + rec_id, deleteCartGoodsResponse, 'POST', 'JSON');
                }

                /**
                 * 接收返回的信息
                 */
                function deleteCartGoodsResponse(res) {
                    if (res.error) {
                        alert(res.err_msg);
                    }
                    else {
                        $("#ECS_CARTINFO").html(res.content);
                    }
                }

            </script>
        </div>
        <div class="topbar-info J_userInfo" id="ECS_MEMBERZONE">
            @if (!empty($user_id))
                <span class="user">
                    <a class="user-name" target="_blank" href="user.php"><span class="name">{{$user_id}}</span><i
                            class="iconfont"></i></a>
                    <ul class="user-menu">
                        <li><a target="_blank" href="user.php">个人中心</a></li>
                        <li><a target="_blank" href="user.php?act=track_packages">跟踪包裹</a></li>
                        <li><a href="user.php?act=logout">退出登录</a></li>
                    </ul>
                </span>
            @else
                <a href="home-user-login" class="link">登录</a>
                <span class="sep">|</span> <a href="home-user-register" class="link">注册</a>
            @endif    
            <span class="sep">|</span> <a href="user.php?act=order_list" class="link">我的订单</a>
        </div>
    </div>
</div>
<div class="site-header" style="clear:both;">
    <div class="container">
        <div class="header-logo">
            <a href="index.php" title="小米商城"><img src="images/logo.gif"/></a>
        </div>

        <div class="header-nav">
            <ul class="nav-list">

                <!--商品分类导航-->
                <li class="nav-category">
                    <a class="btn-category-list" href="catalog.php">全部商品分类</a>
                    <div class="site-category category-hidden">
                        <ul class="site-category-list clearfix" id="site-category-list">

                                                 
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="link" href="{{URL::to('/')}}"><span>首页</span></a>
                </li>
                <!--导航栏-->
                <li class="nav-item">
                    <a class="link" href="home-goods-index?category_id=1"><span>儿童</span></a>
                    <div class='item-children'>
                        <div class="container">
                            <ul class="children-list clearfix">
                                <li class="first">
                                    <div class="figure figure-thumb">
                                        <a href="goods.php?id=27"><img src="images/goods.jpg" alt="小米电视2 40英寸"></a>
                                    </div>
                                    <div class="title">
                                        <a href="goods.php?id=27">小米电视2 40英寸</a>
                                    </div>
                                    <p class="price">2200<em>元</em>元</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="link" href="home-goods-index?category_id=4"><span>孕妇</span></a>
                    <div class='item-children'>
                        <div class="container">
                            <ul class="children-list clearfix">
                                <li class="first">
                                    <div class="figure figure-thumb">
                                        <a href="goods.php?id=82"><img src="images/goods.jpg" alt="红米手机2A"></a>
                                    </div>
                                    <div class="title"><a href="goods.php?id=82">红米手机2A</a></div>
                                    <p class="price">899<em>元</em>元</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="link" href="group_buy.php"><span>早教</span></a>
                </li>
                <li class="nav-item">
                    <a class="link" href="group_buy.php"><span>论坛</span></a>
                </li>
            </ul>
        </div>

        <!--搜索框-->
        <div class="header-search">
            <form action="search.php" method="get" id="searchForm" name="searchForm" onSubmit="return checkSearchForm()"
                  class="search-form clearfix">
                <label class="hide">站内搜索</label>
                <input class="search-text" type="text" name="keywords" id="keyword" value="" autocomplete="off">
                <input type="hidden" value="k1" name="dataBi">
                <button type="submit" class="search-btn iconfont"></button>
                <div class="hot-words">
                    <a href="search.php?keywords=%E5%B0%8F%E7%B1%B3%E6%89%8B%E7%8E%AF" target="_blank">小米手环</a>
                    <a href="search.php?keywords=%E8%80%B3%E6%9C%BA" target="_blank">耳机</a>
                </div>
            </form>
        </div>
    </div>
    <div id="J_navMenu" class="header-nav-menu" style="display: none;">
        <div class="container"></div>
    </div>
</div>

 @yield('content')

 <div class="site-footer">
    <div class="container">
        <div class="footer-service">
            <ul class="list-service clearfix">
                <li>
                    <a rel="nofollow" href="javascript:void(0)">
                        <i class="iconfont"></i>1小时快修服务
                    </a>
                </li>
                <li>
                    <a rel="nofollow" href="javascript:void(0)">
                        <i class="iconfont"></i>7天无理由退货
                    </a>
                </li>
                <li>
                    <a rel="nofollow" href="javascript:void(0)">
                        <i class="iconfont"></i>15天免费换货
                    </a>
                </li>
                <li>
                    <a rel="nofollow" href="javascript:void(0)">
                        <i class="iconfont"></i>满150元包邮
                    </a>
                </li>
                <li>
                    <a rel="nofollow" href="javascript:void(0)">
                        <i class="iconfont"></i>520余家售后网点
                    </a>
                </li>
            </ul>
        </div>
        <div class="footer-links clearfix">
            <div class="blank"></div>

            <dl class="col-links">
                <dt>帮助中心</dt>
                <dd>
                    <a href="javascript:void(0)" target="_blank" title="配送方式" rel="nofollow">配送方式</a>
                </dd>
                <dd>
                    <a href="javascript:void(0)" target="_blank" title="支付方式" rel="nofollow">支付方式</a>
                </dd>
                <dd>
                    <a href="javascript:void(0)" target="_blank" title="购物指南" rel="nofollow">购物指南</a>
                </dd>

            </dl>


            <dl class="col-links">
                <dt>服务支持</dt>
                <dd>
                    <a href="javascript:void(0)" target="_blank" title="相关下载" rel="nofollow">相关下载</a>
                </dd>
                <dd>
                    <a href="javascript:void(0)" target="_blank" title="自助服务" rel="nofollow">自助服务</a>
                </dd>
                <dd>
                    <a href="javascript:void(0)" target="_blank" title="售后政策" rel="nofollow">售后政策</a>
                </dd>

            </dl>


            <dl class="col-links">
                <dt>宝宝之家</dt>
                <dd>
                    <a href="javascript:void(0)" target="_blank" title="预约亲临到店服务" rel="nofollow">预约亲临到店服务</a>
                </dd>
                <dd>
                    <a href="javascript:void(0)" target="_blank" title="服务网点" rel="nofollow">服务网点</a>
                </dd>
                <dd>
                    <a href="javascript:void(0)" target="_blank" title="小米之家" rel="nofollow">宝宝之家</a>
                </dd>

            </dl>


            <dl class="col-links">
                <dt>关于我们</dt>
                <dd>
                    <a href="javascript:void(0)" target="_blank" title="联系小米" rel="nofollow">联系我们</a>
                </dd>
                <dd>
                    <a href="javascript:void(0)" target="_blank" title="加入小米" rel="nofollow">加入我们</a>
                </dd>
                <dd>
                    <a href="javascript:void(0)" target="_blank" title="了解小米" rel="nofollow">了解我们</a>
                </dd>

            </dl>


            <dl class="col-links">
                <dt>关注我们</dt>
                <dd>
                    <a href="javascript:void(0)" target="_blank" title="官方微信" rel="nofollow">官方微信</a>
                </dd>
                <dd>
                    <a href="javascript:void(0)" target="_blank" title="小米部落" rel="nofollow">baby部落</a>
                </dd>
                <dd>
                    <a href="javascript:void(0)" target="_blank" title="新浪微博" rel="nofollow">新浪微博</a>
                </dd>

            </dl>

            <div class="col-contact">
                <p class="phone">0001-000-000</p>
                <p>周一至周日 8:00-18:00<br>（仅收市话费）</p>
                <a rel="nofollow" class="btn btn-line-primary btn-small" href="javascript:void(0)" target="_blank">
                    <i class="iconfont"></i> 24小时在线客服
                </a>
            </div>
        </div>
    </div>
</div>
<div class="site-info">
    <div class="container">
        <div class="logo ir">baby商城</div>
        <div class="info-text">
            <p class="sites">
                <a href="javascript:void(0)" target="_blank" title="买否网">买否网</a>
                <span class="sep">|</span>
                <a href="javascript:void(0)" target="_blank" title="免费开独立网店">免费开独立网店</a>
            </p>
            <p>
                ©<a href='#'>mi.com</a> 京ICP证110507号 京ICP备10046444号 京公网安备1101080212535号 <a
                    href='#'>京网文[2014]0059-0009号</a>
            </p>
        </div>
        <div class="info-links">
            <a href="#"><img src="http://s1.mi.com/zt/12052601/cnnicVerifyseal.png" alt="可信网站"></a>
            <a href="#"><img src="http://s1.mi.com/zt/12052601/szfwVerifyseal.gif" alt="诚信网站"></a>
            <a href="#"><img src="http://s1.mi.com/zt/12052601/save.jpg" alt="网上交易保障中心"></a>
        </div>
    </div>
</div>
</body>
</html>
<script>
$(function(){
    $.ajax({
        type:'post',
        url:'home-index-getCategory',
        dataType:'json',
        success:function(msg){
            var str = '';
            $.each(msg,function(k,v){
                str+='<li class="category-item">';

                str+='<a class="title" href="category.php?id=69">'+k+'<i class="iconfont"></i></a>';
                str+='<div class="children clearfix"><ul class="children-list">';
                $.each(v,function(k1,v1){
                    str+='<li><a href="category.php?id=70" class="link"  style="width: 280px">';
                    str+='<span><b style="color:pink">'+k1+'</b></span><br>';
                    $.each(v1,function(k2,v2){
                        str+='<span class="thumb">'+v2+'</span>';
                    })
                    str+='</a></li>';
                })                    
                 str+='</ul></div></li>';                                                              
            })
            $('#site-category-list').html(str);
        }

    })
})
</script>


