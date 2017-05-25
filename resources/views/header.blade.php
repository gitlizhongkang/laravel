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

    <!-- <script type="text/javascript" src="js/common.js"></script> -->
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
    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
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
        	<span class="user">
                <a class="user-name" target="_blank" href="user.php"><span class="name">aaaa</span><i
                        class="iconfont"></i></a>
                <ul class="user-menu">
                    <li><a target="_blank" href="user.php">个人中心</a></li>
                    <li><a target="_blank" href="user.php?act=track_packages">跟踪包裹</a></li>
                    <li><a href="user.php?act=logout">退出登录</a></li>
                </ul>
            </span>
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
                <!--导航栏-->
                <li class="nav-item">
                    <a class="link" href="" class="current"><span>首页</span></a>
                </li>
                <li class="nav-item">
                    <a class="link" href="category.php?id=69"><span>儿童</span></a>
                    <div class='item-children'>
                        <div class="container">
                            <ul class="children-list clearfix">
                                <li class="first">
                                    <div class="figure figure-thumb"><a href="goods.php?id=82"><img
                                            src="images/goods.jpg" alt="红米手机2A"></a>
                                    </div>
                                    <div class="title"><a href="goods.php?id=82">红米手机2A</a></div>
                                    <p class="price">899<em>元</em>元</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                 <li class="nav-item">
                    <a class="link" href="category.php?id=69"><span>孕妇</span></a>
                    <div class='item-children'>
                        <div class="container">
                            <ul class="children-list clearfix">
                                <li class="first">
                                    <div class="figure figure-thumb"><a href="goods.php?id=82"><img
                                            src="images/goods.jpg" alt="红米手机2A"></a>
                                    </div>
                                    <div class="title"><a href="goods.php?id=82">红米手机2A</a></div>
                                    <p class="price">899<em>元</em>元</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                 <li class="nav-item">
                    <a class="link" href="category.php?id=69"><span>早教</span></a>
                    <div class='item-children'>
                        <div class="container">
                            <ul class="children-list clearfix">
                                <li class="first">
                                    <div class="figure figure-thumb"><a href="goods.php?id=82"><img
                                            src="images/goods.jpg" alt="红米手机2A"></a>
                                    </div>
                                    <div class="title"><a href="goods.php?id=82">红米手机2A</a></div>
                                    <p class="price">899<em>元</em>元</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                 <li class="nav-item">
                    <a class="link" href="category.php?id=69"><span>论坛</span></a>
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
                    <a href="search.php?keywords=%E5%B0%8F%E7%B1%B3%E6%89%8B%E7%8E%AF" target="_blank">奶粉</a>
                    <a href="search.php?keywords=%E8%80%B3%E6%9C%BA" target="_blank">孕妇装</a>
                </div>
            </form>
        </div>
    </div>
    <div id="J_navMenu" class="header-nav-menu" style="display: none;">
        <div class="container"></div>
    </div>
</div>




