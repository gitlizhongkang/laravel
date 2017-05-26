<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>商城</title>
    <link rel="shortcut icon" href="favicon.ico"/>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <link href="css/category.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="js/xiaomi_category.js"></script>
    <script type="text/javascript" src="js/global.js"></script>
    <script type="text/javascript" src="js/easydialog.min.js"></script>
    <script type="text/javascript" src="js/compare.js"></script>
    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.json.js"></script>
    <script type="text/javascript" src="js/transport_jquery.js"></script>
    <script type="text/javascript" src="js/utils.js"></script>
    <script type="text/javascript" src="js/jquery.SuperSlide.js"></script>
    <script type="text/javascript" src="js/common.js"></script>
    <script type="text/javascript" src="js/xiaomi_common.js"></script>

    <script type="text/javascript">

        function checkSearchForm() {
            if (document.getElementById('keyword').value) {
                return true;
            }
            else {
                alert("请输入搜索关键词！");
                return false;
            }
        }

    </script>
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
            <a href="index.php" title="小米商城"><img src="themes/xiaomi/images/logo.gif" /></a>
        </div>
        <div class="header-nav">
            <ul class="nav-list">
                <li class="nav-category">
                    <a class="btn-category-list" href="catalog.php" >全部商品分类</a>
                    <div class="site-category category-hidden">
                        <ul class="site-category-list clearfix" id="site-category-list">
                            <li class="category-item">
                                <a class="title" href="category.php?id=69">购买手机<i class="iconfont"></i></a>
                                <div class="children clearfix">
                                    <ul class="children-list">
                                        <li>
                                            <a href="category.php?id=70" class="link">
                                                <img class="thumb" src="data/catthumb/1440694830757590201.jpg" width="40" height="40">
                                                <span>小米Note</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="category.php?id=71" class="link">
                                                <img class="thumb" src="data/catthumb/1440714333309950345.jpg" width="40" height="40">
                                                <span>小米手机4</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="category-item">
                                <a class="title" href="category.php?id=76">购买电视与平板<i class="iconfont"></i></a>
                                <div class="children clearfix">
                                    <ul class="children-list">
                                        <li>
                                            <a href="category.php?id=77" class="link">
                                                <img class="thumb" src="data/catthumb/1440714523818497367.jpg" width="40" height="40">
                                                <span>小米电视2</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="category.php?id=78" class="link">
                                                <img class="thumb" src="data/catthumb/1440714530518865434.jpg" width="40" height="40">
                                                <span>小米盒子</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="link" href="category.php?id=76"   class="current"><span>购买电视与平板</span></a>
                    <div class='item-children'>
                        <div class="container">
                            <ul class="children-list clearfix">
                                <li class="first">
                                    <div class="figure figure-thumb"><a href="goods.php?id=27"><img src="images/201507/thumb_img/27_thumb_G_1437074702008.jpg"  alt="小米电视2 40英寸"></a></div>
                                    <div class="title"><a href="goods.php?id=27">小米电视2 40英寸</a></div>
                                    <p class="price">2200<em>元</em>元</p>
                                </li>
                                <li class="first">
                                    <div class="figure figure-thumb"><a href="goods.php?id=28"><img src="images/201507/thumb_img/28_thumb_G_1437074792369.jpg"  alt="小米平板 16G"></a></div>
                                    <div class="title"><a href="goods.php?id=28">小米平板 16G</a></div>
                                    <p class="price">1299<em>元</em>元</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="link" href="category.php?id=69"  ><span>购买手机</span></a>
                    <div class='item-children'>
                        <div class="container">
                            <ul class="children-list clearfix">
                                <li class="first">
                                    <div class="figure figure-thumb"><a href="goods.php?id=82"><img src="images/201509/thumb_img/82_thumb_G_1441050801926.jpg"  alt="红米手机2A"></a></div>
                                    <div class="title"><a href="goods.php?id=82">红米手机2A</a></div>
                                    <p class="price">899<em>元</em>元</p>
                                </li>
                                <li class="first">
                                    <div class="figure figure-thumb"><a href="goods.php?id=80"><img src="images/201509/thumb_img/80_thumb_G_1441050558701.jpg"  alt="小米NOTE"></a></div>
                                    <div class="title"><a href="goods.php?id=80">小米NOTE</a></div>
                                    <p class="price">2199<em>元</em>元</p>
                                </li>
                            </ul>
                        </div>
                    </div>
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

<!--通栏-->
<div class="breadcrumbs">
    <div class="container">
        <a href=".">首页</a> <code>&gt;</code> <a href="category.php?id=76">购买电视与平板</a>
    </div>
</div>

<!--分类-->
<div class="container">
    <div class="filter-box">
        <div class="filter-list-wrap">
            <dl class="filter-list clearfix filter-list-row-2">
                <dt>颜色：</dt>
                <dd class="active">全部</dd>
                <dd><a href="category.php?id=76&amp;price_min=0&amp;price_max=0&amp;filter_attr=38.0">黄</a></dd>
                <dd><a href="category.php?id=76&amp;price_min=0&amp;price_max=0&amp;filter_attr=34.0">黑</a></dd>
                <dd><a href="category.php?id=76&amp;price_min=0&amp;price_max=0&amp;filter_attr=81.0">黑白</a></dd>
            </dl>
            <a  href="javascript:;" class="more J_filterToggle">更多<i class="iconfont"></i></a>
        </div>
        <div class="filter-list-wrap">
            <dl class="filter-list clearfix filter-list-row-2">
                <dt>尺寸：</dt>
                <dd class="active">全部</dd>
                <dd><a href="category.php?id=76&amp;price_min=0&amp;price_max=0&amp;filter_attr=0.33">15</a></dd>
                <dd><a href="category.php?id=76&amp;price_min=0&amp;price_max=0&amp;filter_attr=0.35">45</a></dd>
                <dd><a href="category.php?id=76&amp;price_min=0&amp;price_max=0&amp;filter_attr=0.68">58</a></dd>
            </dl>
            <a  href="javascript:;" class="more J_filterToggle">更多<i class="iconfont"></i></a>
        </div>
        <div class="filter-list-wrap">
            <dl class="filter-list clearfix filter-list-row-2">
                <dt>价格：</dt>
                <dd class="active">全部</dd>
                <dd><a href="category.php?id=76&amp;price_min=0&amp;price_max=500">0&nbsp;-&nbsp;500</a></dd>
                <dd><a href="category.php?id=76&amp;price_min=1000&amp;price_max=1500">1000&nbsp;-&nbsp;1500</a></dd>
                <dd><a href="category.php?id=76&amp;price_min=2000&amp;price_max=2500">2000&nbsp;-&nbsp;2500</a></dd>
                <dd><a href="category.php?id=76&amp;price_min=2500&amp;price_max=3000">2500&nbsp;-&nbsp;3000</a></dd>
                <dd><a href="category.php?id=76&amp;price_min=4000&amp;price_max=4500">4000&nbsp;-&nbsp;4500</a></dd>
            </dl>
            <a  href="javascript:;" class="more J_filterToggle">更多<i class="iconfont"></i></a>
        </div>
    </div>
</div>

<!--内容展示-->
<div class="content">
    <div class="container">
        <!--排序-->
        <div class="order-list-box clearfix">
            <form method="GET" name="listform">
                <ul class="order-list">
                    <li class="first active">
                        <a title="销量" href="category.php?category=76&display=grid&brand=0&price_min=0&price_max=0&filter_attr=0&page=1&sort=sales_volume&order=ASC#goods_list" class="curr" rel="nofollow">
                            <span class="search_DESC">销量</span>&nbsp;<i class="iconfont"></i>
                        </a>
                    </li>
                    <li class="">
                        <a title="价格" href="category.php?category=76&display=grid&brand=0&price_min=0&price_max=0&filter_attr=0&page=1&sort=shop_price&order=ASC#goods_list"  rel="nofollow">
                            <span class="">价格</span>
                        </a>
                    </li>
                    <li class="">
                        <a title="上架时间" href="category.php?category=76&display=grid&brand=0&price_min=0&price_max=0&filter_attr=0&page=1&sort=goods_id&order=DESC#goods_list" rel="nofollow">
                            <span class="">上架时间</span>
                        </a>
                    </li>
                    <input type="hidden" name="category" value="76" />
                    <input type="hidden" name="display" value="grid" id="display" />
                    <input type="hidden" name="brand" value="0" />
                    <input type="hidden" name="price_min" value="0" />
                    <input type="hidden" name="price_max" value="0" />
                    <input type="hidden" name="filter_attr" value="0" />
                    <input type="hidden" name="page" value="1" />
                    <input type="hidden" name="sort" value="sales_volume" />
                    <input type="hidden" name="order" value="DESC" />
                </ul>
            </form>
            <ul class="type-list">
                <li>显示方式：</li>
                <li> <a href="javascript:;" onClick="javascript:display_mode('list')"><img src="themes/xiaomi/images/display_mode_list.gif" alt=""></a></li>
                <li><a href="javascript:;" onClick="javascript:display_mode('grid')"><img src="themes/xiaomi/images/display_mode_grid_act.gif" alt=""></a></li>
                <li><a href="javascript:;" onClick="javascript:display_mode('text')"><img src="themes/xiaomi/images/display_mode_text.gif" alt=""></a></li>&nbsp;&nbsp;
            </ul>
        </div>

        <!--内容-->
        <form name="compareForm" action="compare.php" method="post" onSubmit="return compareGoods(this);">
            <div class="goods-list-box">
                <div class="goods-list clearfix">
                    <div class="goods-item">
                        <div class="figure figure-img">
                            <a href="goods.php?id=29"><img src="images/201507/thumb_img/29_thumb_G_1437074933275.jpg" alt="小米盒子增强版 1G" class="goodsimg" /></a>
                        </div>
                        <p class="desc">首款4K超高清网络机顶盒</p>
                        <h2 class="title"><a href="goods.php?id=29" title="小米盒子增强版 1G">小米盒子增强版 1G</a></h2>
                        <p class="price">
                            本店价<font class="shop_s">299<em>元</em></font>
                            <del>专柜价<font class="market_s">358<em>元</em></font></del>
                        </p>
                        <div class="thumbs J_attrImg">
                            <div style="width:212px;margin:0 auto;">
                                <ul class="thumb-list clearfix J_imgList">
                                    <li class="active" data-config='{figure:"images/201507/thumb_img/29_thumb_P_1437074933782.jpg"}'>
                                        <a><img src="images/201507/thumb_img/29_thumb_P_1437074933782.jpg" width="34" height="34"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="actions clearfix">
                            <a href="javascript:collect(29);" class="btn-like J_likeGoods"><i class="iconfont"></i> <span>收藏</span></a>
                            <a href="javascript:addToCart(29)" class="btn-buy J_buyGoods"><span>购买</span> <i class="iconfont"></i></a>
                        </div>
                        <div class="flags">
                            <div class="flag flag-saleoff">8.4折促销</div>
                        </div>
                    </div>
                    <div class="goods-item">
                        <div class="figure figure-img">
                            <a href="goods.php?id=28"><img src="images/201507/thumb_img/28_thumb_G_1437074792369.jpg" alt="小米平板 16G" class="goodsimg" /></a>
                        </div>
                        <p class="desc">全球首款搭载 NVIDIA Tegra K1 处理器平板</p>
                        <h2 class="title"><a href="goods.php?id=28" title="小米平板 16G">小米平板 16G</a></h2>
                        <p class="price">
                            本店价<font class="shop_s">1299<em>元</em></font>
                            <del>专柜价<font class="market_s">1558<em>元</em></font></del>
                        </p>
                        <div class="thumbs J_attrImg">
                            <div style="width:212px;margin:0 auto;">
                                <ul class="thumb-list clearfix J_imgList">
                                    <li class="active" data-config='{figure:"images/201507/thumb_img/28_thumb_P_1437074792079.jpg"}'>
                                        <a><img src="images/201507/thumb_img/28_thumb_P_1437074792079.jpg" width="34" height="34"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="actions clearfix">
                            <a href="javascript:collect(28);" class="btn-like J_likeGoods"><i class="iconfont"></i> <span>收藏</span></a>
                            <a href="javascript:addToCart(28)" class="btn-buy J_buyGoods"><span>购买</span> <i class="iconfont"></i></a>
                        </div>
                        <div class="flags">

                            <div class="flag flag-saleoff">8.3折促销</div>

                        </div>
                    </div>
                    <div class="goods-item">
                        <div class="figure figure-img">
                            <a href="goods.php?id=27"><img src="images/201507/thumb_img/27_thumb_G_1437074702008.jpg" alt="小米电视2 40英寸" class="goodsimg" /></a>
                        </div>
                        <p class="desc">40/49/55英寸 现货购买</p>
                        <h2 class="title"><a href="goods.php?id=27" title="小米电视2 40英寸">小米电视2 40英寸</a></h2>
                        <p class="price">
                            本店价<font class="shop_s">2200<em>元</em></font>
                            <del>专柜价<font class="market_s">2640<em>元</em></font></del>
                        </p>
                        <div class="thumbs J_attrImg">
                            <div style="width:212px;margin:0 auto;">
                                <ul class="thumb-list clearfix J_imgList">
                                    <li class="active" data-config='{figure:"images/201507/thumb_img/27_thumb_P_1437074702931.jpg"}'>
                                        <a><img src="images/201507/thumb_img/27_thumb_P_1437074702931.jpg" width="34" height="34"></a>
                                    </li>
                                    <li  data-config='{figure:"images/201508/thumb_img/27_thumb_P_1440636492790.jpg"}'>
                                        <a><img src="images/201508/thumb_img/27_thumb_P_1440636492790.jpg" width="34" height="34"></a>
                                    </li>
                                    <li  data-config='{figure:"images/201508/thumb_img/27_thumb_P_1440636386334.jpg"}'>
                                        <a><img src="images/201508/thumb_img/27_thumb_P_1440636386334.jpg" width="34" height="34"></a>
                                    </li>
                                    <li  data-config='{figure:"images/201508/thumb_img/27_thumb_P_1440636396876.jpg"}'>
                                        <a><img src="images/201508/thumb_img/27_thumb_P_1440636396876.jpg" width="34" height="34"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="actions clearfix">
                            <a href="javascript:collect(27);" class="btn-like J_likeGoods"><i class="iconfont"></i> <span>收藏</span></a>
                            <a href="javascript:addToCart(27)" class="btn-buy J_buyGoods"><span>购买</span> <i class="iconfont"></i></a>
                        </div>
                        <div class="flags">

                            <div class="flag flag-saleoff">8.3折促销</div>

                        </div>
                    </div>
                    <div class="goods-item">
                        <div class="figure figure-img">
                            <a href="goods.php?id=76"><img src="images/201508/thumb_img/76_thumb_G_1440984280864.jpg" alt="小米盒子mini版" class="goodsimg" /></a>
                        </div>
                        <p class="desc"></p>
                        <h2 class="title"><a href="goods.php?id=76" title="小米盒子mini版">小米盒子mini版</a></h2>
                        <p class="price">
                            本店价<font class="shop_s">199<em>元</em></font>
                            <del>专柜价<font class="market_s">239<em>元</em></font></del>
                        </p>
                        <div class="thumbs J_attrImg">
                            <div style="width:212px;margin:0 auto;">
                                <ul class="thumb-list clearfix J_imgList">
                                    <li class="active" data-config='{figure:"images/201508/thumb_img/76_thumb_G_1440984280864.jpg"}'>
                                        <a><img src="images/201508/thumb_img/76_thumb_G_1440984280864.jpg" width="34" height="34"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="actions clearfix">
                            <a href="javascript:collect(76);" class="btn-like J_likeGoods"><i class="iconfont"></i> <span>收藏</span></a>
                            <a href="javascript:addToCart(76)" class="btn-buy J_buyGoods"><span>购买</span> <i class="iconfont"></i></a>
                        </div>
                        <div class="flags">

                            <div class="flag flag-saleoff">8.3折促销</div>

                        </div>
                    </div>
                    <div class="goods-item">
                        <div class="figure figure-img">
                            <a href="goods.php?id=53"><img src="images/201508/thumb_img/53_thumb_G_1439511514539.jpg" alt="小米电视2S48英寸" class="goodsimg" /></a>
                        </div>
                        <p class="desc"></p>
                        <h2 class="title"><a href="goods.php?id=53" title="小米电视2S48英寸">小米电视2S48英寸</a></h2>
                        <p class="price">
                            本店价<font class="shop_s">2999<em>元</em></font>
                            <del>专柜价<font class="market_s">3599<em>元</em></font></del>
                        </p>
                        <div class="thumbs J_attrImg">
                            <div style="width:212px;margin:0 auto;">
                                <ul class="thumb-list clearfix J_imgList">
                                    <li class="active" data-config='{figure:"images/201508/thumb_img/53_thumb_P_1439511514984.jpg"}'>
                                        <a><img src="images/201508/thumb_img/53_thumb_P_1439511514984.jpg" width="34" height="34"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="actions clearfix">
                            <a href="javascript:collect(53);" class="btn-like J_likeGoods"><i class="iconfont"></i> <span>收藏</span></a>
                            <a href="javascript:addToCart(53)" class="btn-buy J_buyGoods"><span>购买</span> <i class="iconfont"></i></a>
                        </div>
                        <div class="flags">

                            <div class="flag flag-saleoff">8.3折促销</div>

                        </div>
                    </div>
                    <div class="goods-item">
                        <div class="figure figure-img">
                            <a href="goods.php?id=54"><img src="images/201508/thumb_img/54_thumb_G_1439511600535.jpg" alt="小米电视2 55英寸" class="goodsimg" /></a>
                        </div>
                        <p class="desc"></p>
                        <h2 class="title"><a href="goods.php?id=54" title="小米电视2 55英寸">小米电视2 55英寸</a></h2>
                        <p class="price">
                            本店价<font class="shop_s">4499<em>元</em></font>
                            <del>专柜价<font class="market_s">5399<em>元</em></font></del>
                        </p>
                        <div class="thumbs J_attrImg">
                            <div style="width:212px;margin:0 auto;">
                                <ul class="thumb-list clearfix J_imgList">
                                    <li class="active" data-config='{figure:"images/201508/thumb_img/54_thumb_P_1439511600402.jpg"}'>
                                        <a><img src="images/201508/thumb_img/54_thumb_P_1439511600402.jpg" width="34" height="34"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="actions clearfix">
                            <a href="javascript:collect(54);" class="btn-like J_likeGoods"><i class="iconfont"></i> <span>收藏</span></a>
                            <a href="javascript:addToCart(54)" class="btn-buy J_buyGoods"><span>购买</span> <i class="iconfont"></i></a>
                        </div>
                        <div class="flags">

                            <div class="flag flag-saleoff">8.3折促销</div>

                        </div>
                    </div>
                    <div class="goods-item">
                        <div class="figure figure-img">
                            <a href="goods.php?id=55"><img src="images/201508/thumb_img/55_thumb_G_1439511725721.jpg" alt="小米平板 64GB" class="goodsimg" /></a>
                        </div>
                        <p class="desc"></p>
                        <h2 class="title"><a href="goods.php?id=55" title="小米平板 64GB">小米平板 64GB</a></h2>
                        <p class="price">
                            本店价<font class="shop_s">1499<em>元</em></font>
                            <del>专柜价<font class="market_s">1799<em>元</em></font></del>
                        </p>
                        <div class="thumbs J_attrImg">
                            <div style="width:212px;margin:0 auto;">
                                <ul class="thumb-list clearfix J_imgList">
                                    <li class="active" data-config='{figure:"images/201508/thumb_img/55_thumb_P_1439511725800.jpg"}'>
                                        <a><img src="images/201508/thumb_img/55_thumb_P_1439511725800.jpg" width="34" height="34"></a>
                                    </li>
                                    <li  data-config='{figure:"images/201509/thumb_img/55_thumb_P_1441498030464.jpg"}'>
                                        <a><img src="images/201509/thumb_img/55_thumb_P_1441498030464.jpg" width="34" height="34"></a>
                                    </li>
                                    <li  data-config='{figure:"images/201509/thumb_img/55_thumb_P_1441498030567.jpg"}'>
                                        <a><img src="images/201509/thumb_img/55_thumb_P_1441498030567.jpg" width="34" height="34"></a>
                                    </li>
                                    <li  data-config='{figure:"images/201509/thumb_img/55_thumb_P_1441498031661.jpg"}'>
                                        <a><img src="images/201509/thumb_img/55_thumb_P_1441498031661.jpg" width="34" height="34"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="actions clearfix">
                            <a href="javascript:collect(55);" class="btn-like J_likeGoods"><i class="iconfont"></i> <span>收藏</span></a>
                            <a href="javascript:addToCart(55)" class="btn-buy J_buyGoods"><span>购买</span> <i class="iconfont"></i></a>
                        </div>
                        <div class="flags">

                            <div class="flag flag-saleoff">8.3折促销</div>

                        </div>
                    </div>
                    <div class="goods-item">
                        <div class="figure figure-img">
                            <a href="goods.php?id=77"><img src="images/201508/thumb_img/77_thumb_G_1440984390480.jpg" alt="小米电视/盒子遥控器" class="goodsimg" /></a>
                        </div>
                        <p class="desc"></p>
                        <h2 class="title"><a href="goods.php?id=77" title="小米电视/盒子遥控器">小米电视/盒子遥控器</a></h2>
                        <p class="price">
                            本店价<font class="shop_s">29<em>元</em></font>
                            <del>专柜价<font class="market_s">35<em>元</em></font></del>
                        </p>
                        <div class="thumbs J_attrImg">
                            <div style="width:212px;margin:0 auto;">
                                <ul class="thumb-list clearfix J_imgList">
                                    <li class="active" data-config='{figure:"images/201508/thumb_img/77_thumb_G_1440984390480.jpg"}'>
                                        <a><img src="images/201508/thumb_img/77_thumb_G_1440984390480.jpg" width="34" height="34"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="actions clearfix">
                            <a href="javascript:collect(77);" class="btn-like J_likeGoods"><i class="iconfont"></i> <span>收藏</span></a>
                            <a href="javascript:addToCart(77)" class="btn-buy J_buyGoods"><span>购买</span> <i class="iconfont"></i></a>
                        </div>
                        <div class="flags">

                            <div class="flag flag-saleoff">8.3折促销</div>

                        </div>
                    </div>
                </div>
            </div>
        </form>

        <script type="Text/Javascript" language="JavaScript">
            function selectPage(sel)
            {
                sel.form.submit();
            }
        </script>
        <script type="text/javascript">
            window.onload = function()
            {
                Compare.init();
                fixpng();
            };
            var button_compare = '';
            var exist = "您已经选择了%s";
            var count_limit = "最多只能选择4个商品进行对比";
            var goods_type_different = "\"%s\"和已选择商品类型不同无法进行对比";
            var compare_no_goods = "您没有选定任何需要比较的商品或者比较的商品数少于 2 个。";
            var btn_buy = "购买";
            var is_cancel = "取消";
            var select_spe = "请选择商品属性";
        </script>
        <form name="selectPageForm" action="/mishop/category.php" method="get">
            <div class="clearfix">
                <div id="pager" class="pagebar">
                    <span class="f_l f6" style="margin-right:10px;">总计 <b>10</b>  个记录</span>
                </div>
            </div>
        </form>
        <script type="Text/Javascript" language="JavaScript">
            function selectPage(sel)
            {
                sel.form.submit();
            }
        </script>
    </div>

    <div id="J_renovateWrap" class="xm-recommend-container container xm-carousel-container">
        <h2 class="xm-recommend-title"><span>为你推荐</span></h2>
        <div class="xm-recommend">
            <div class="xm-carousel-wrapper">
                <ul class="xm-carousel-col-5-list xm-carousel-list clearfix">
                    <li class="J_xm-recommend-list">
                        <dl>
                            <dt><a href="goods.php?id=27" target="_blank"><img src="images/201507/thumb_img/27_thumb_G_1437074702008.jpg" /></a></dt>
                            <dd class="xm-recommend-name"><a href="goods.php?id=27" target="_blank" title="小米电视2 40英寸">小米电视2 40英寸</a></dd>
                            <dd class="xm-recommend-price">2200<em>元</em></dd>
                            <dd class="xm-recommend-tips"> </dd>
                        </dl>
                    </li>

                    <li class="J_xm-recommend-list">
                        <dl>
                            <dt><a href="goods.php?id=28" target="_blank"><img src="images/201507/thumb_img/28_thumb_G_1437074792369.jpg" /></a></dt>
                            <dd class="xm-recommend-name"><a href="goods.php?id=28" target="_blank" title="小米平板 16G">小米平板 16G</a></dd>
                            <dd class="xm-recommend-price">1299<em>元</em></dd>
                            <dd class="xm-recommend-tips"> </dd>
                        </dl>
                    </li>

                    <li class="J_xm-recommend-list">
                        <dl>
                            <dt><a href="goods.php?id=29" target="_blank"><img src="images/201507/thumb_img/29_thumb_G_1437074933275.jpg" /></a></dt>
                            <dd class="xm-recommend-name"><a href="goods.php?id=29" target="_blank" title="小米盒子增强版 1G">小米盒子增强版 1G</a></dd>
                            <dd class="xm-recommend-price">299<em>元</em></dd>
                            <dd class="xm-recommend-tips"> </dd>
                        </dl>
                    </li>

                    <li class="J_xm-recommend-list">
                        <dl>
                            <dt><a href="goods.php?id=53" target="_blank"><img src="images/201508/thumb_img/53_thumb_G_1439511514539.jpg" /></a></dt>
                            <dd class="xm-recommend-name"><a href="goods.php?id=53" target="_blank" title="小米电视2S48英寸">小米电视2S48英寸</a></dd>
                            <dd class="xm-recommend-price">2999<em>元</em></dd>
                            <dd class="xm-recommend-tips"> </dd>
                        </dl>
                    </li>

                </ul>
            </div>
            <div class="xm-pagers-wrapper">
                <ul class="xm-pagers">
                    <li class="pager"><span class="dot">1</span></li>
                    <li class="pager"><span class="dot">6</span></li>
                </ul>
            </div>
        </div>
    </div>


</div>
<div class="add_ok" id="cart_show">
    <div class="tip">
        <i class="iconfont"> </i>商品已成功加入购物车
    </div>
    <div class="go">
        <a href="javascript:easyDialog.close();" class="back">&lt;&lt;继续购物</a>
        <a href="flow.php" class="btn">去结算</a>
    </div>
</div>



<!--脚部-->
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
                <dt>小米之家</dt>
                <dd>
                    <a href="javascript:void(0)" target="_blank" title="预约亲临到店服务" rel="nofollow">预约亲临到店服务</a>
                </dd>
                <dd>
                    <a href="javascript:void(0)" target="_blank" title="服务网点" rel="nofollow">服务网点</a>
                </dd>
                <dd>
                    <a href="javascript:void(0)" target="_blank" title="小米之家" rel="nofollow">小米之家</a>
                </dd>

            </dl>


            <dl class="col-links">
                <dt>关于小米</dt>
                <dd>
                    <a href="javascript:void(0)" target="_blank" title="联系小米" rel="nofollow">联系小米</a>
                </dd>
                <dd>
                    <a href="javascript:void(0)" target="_blank" title="加入小米" rel="nofollow">加入小米</a>
                </dd>
                <dd>
                    <a href="javascript:void(0)" target="_blank" title="了解小米" rel="nofollow">了解小米</a>
                </dd>

            </dl>


            <dl class="col-links">
                <dt>关注小米</dt>
                <dd>
                    <a href="javascript:void(0)" target="_blank" title="官方微信" rel="nofollow">官方微信</a>
                </dd>
                <dd>
                    <a href="javascript:void(0)" target="_blank" title="小米部落" rel="nofollow">小米部落</a>
                </dd>
                <dd>
                    <a href="javascript:void(0)" target="_blank" title="新浪微博" rel="nofollow">新浪微博</a>
                </dd>

            </dl>

            <div class="col-contact">
                <p class="phone">4001-021-758</p>
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
        <div class="logo ir">小米商城</div>
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
