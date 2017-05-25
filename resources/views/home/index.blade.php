<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>商城</title>
    <link rel="shortcut icon" href="favicon.ico"/>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <link href="css/index.css" rel="stylesheet" type="text/css"/>

    <script type="text/javascript" src="js/common.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.json.js"></script>
    <script type="text/javascript" src="js/transport_jquery.js"></script>
    <script type="text/javascript" src="js/utils.js"></script>
    <script type="text/javascript" src="js/jquery.SuperSlide.js"></script>
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
    <script type="text/javascript" src="js/xiaomi_index.js"></script>
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
            <a href="index.php" title="小米商城"><img src="themes/xiaomi/images/logo.gif"/></a>
        </div>
        <div class="header-nav">
            <ul class="nav-list">
                <li class="nav-category">
                    <a class="btn-category-list" href="catalog.php">全部商品分类</a>
                    <div class="site-category">
                        <ul class="site-category-list clearfix" id="site-category-list">
                            <li class="category-item">
                                <a class="title" href="category.php?id=69">购买手机<i class="iconfont"></i></a>
                                <div class="children clearfix">
                                    <ul class="children-list">
                                        <li>
                                            <a href="category.php?id=70" class="link">
                                                <img class="thumb" src="data/catthumb/1440694830757590201.jpg"
                                                     width="40" height="40">
                                                <span>小米Note</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="category.php?id=71" class="link">
                                                <img class="thumb" src="data/catthumb/1440714333309950345.jpg"
                                                     width="40" height="40">
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
                                                <img class="thumb" src="data/catthumb/1440714523818497367.jpg"
                                                     width="40" height="40">
                                                <span>小米电视2</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="category.php?id=78" class="link">
                                                <img class="thumb" src="data/catthumb/1440714530518865434.jpg"
                                                     width="40" height="40">
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
                    <a class="link" href="category.php?id=76" class="current"><span>购买电视与平板</span></a>
                    <div class='item-children'>
                        <div class="container">
                            <ul class="children-list clearfix">
                                <li class="first">
                                    <div class="figure figure-thumb"><a href="goods.php?id=27"><img
                                            src="images/goods.jpg" alt="小米电视2 40英寸"></a>
                                    </div>
                                    <div class="title"><a href="goods.php?id=27">小米电视2 40英寸</a></div>
                                    <p class="price">2200<em>元</em>元</p>
                                </li>
                                <li class="first">
                                    <div class="figure figure-thumb"><a href="goods.php?id=28"><img
                                            src="images/goods.jpg"
                                            alt="小米平板 16G"></a></div>
                                    <div class="title"><a href="goods.php?id=28">小米平板 16G</a></div>
                                    <p class="price">1299<em>元</em>元</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="link" href="category.php?id=69"><span>购买手机</span></a>
                    <div class='item-children'>
                        <div class="container">
                            <ul class="children-list clearfix">
                                <li class="first">
                                    <div class="figure figure-thumb"><a href="goods.php?id=82"><img
                                            src="images/201509/thumb_img/82_thumb_G_1441050801926.jpg" alt="红米手机2A"></a>
                                    </div>
                                    <div class="title"><a href="goods.php?id=82">红米手机2A</a></div>
                                    <p class="price">899<em>元</em>元</p>
                                </li>
                                <li class="first">
                                    <div class="figure figure-thumb"><a href="goods.php?id=80"><img
                                            src="images/201509/thumb_img/80_thumb_G_1441050558701.jpg" alt="小米NOTE"></a>
                                    </div>
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


<div class="home-hero-container container">
    <div class="home-hero">
        <div class="home-hero-slider">
            <div id="J_homeSlider" class="xm-slider" style="overflow:hidden;">
                <div class="xm-slider-container">
                    <div class="xm-slider-control">
                        <div class="slide xm-slider-slide">
                            <a target="_blank" href="http://note.sdufa.com/goods.php?id=35">
                                <img src="images/20151020cqlfjj.jpg"/>
                            </a>
                        </div>
                        <div class="slide xm-slider-slide">
                            <a target="_blank" href="http://note.sdufa.com/goods.php?id=54">
                                <img src="images/20151020eefgbq.jpg"/>
                            </a>
                        </div>
                        <div class="slide xm-slider-slide">
                            <a target="_blank" href="http://note.sdufa.com/goods.php?id=56">
                                <img src="images/20151020etwxly.jpg"/>
                            </a>
                        </div>
                        <div class="slide xm-slider-slide">
                            <a target="_blank" href="http://">
                                <img src="images/20151020cvzklv.jpg"/>
                            </a>
                        </div>
                    </div>
                </div>
                <a class="xm-slider-previous xm-slider-navigation icon-slides icon-slides-prev prev" href="#"
                   style="display:none;">上一张</a>
                <a class="xm-slider-next xm-slider-navigation icon-slides icon-slides-next next" href="#"
                   style="display: none;">下一张</a>
                <ul class="xm-slider-pagination">
                    <li class="xm-slider-pagination-item">
                        <a href="javascript:;" class="active">1</a>
                    </li>
                    <li class="xm-slider-pagination-item">
                        <a href="javascript:;">2</a>
                    </li>
                    <li class="xm-slider-pagination-item">
                        <a href="javascript:;">3</a>
                    </li>
                    <li class="xm-slider-pagination-item">
                        <a href="javascript:;">4</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="home-hero-sub row">
            <div class="span4">
                <ul class="home-channel-list clearfix">
                    <li>
                        <a href="auction.php">
                            <i class="iconfont"></i>拍卖商品
                        </a>
                    </li>
                    <li>
                        <a href="group_buy.php">
                            <i class="iconfont"></i>企业团购
                        </a>
                    </li>
                    <li>
                        <a href="exchange.php">
                            <i class="iconfont"></i>积分商城
                        </a>
                    </li>
                    <li>
                        <a href="snatch.php">
                            <i class="iconfont"></i>夺宝奇兵
                        </a>
                    </li>
                    <li>
                        <a href="brand.php">
                            <i class="iconfont"></i>品牌商品
                        </a>
                    </li>
                    <li>
                        <a href="pick_out.php">
                            <i class="iconfont"></i>选购中心
                        </a>
                    </li>
                </ul>
            </div>
            <div class="span16">

                <ul class="home-promo-list clearfix">
                    <li class="first"><a href='affiche.php?ad_id=9&amp;uri=https%3A%2F%2Fshop115008598.taobao.com%2F'
                                         target='_blank'><img src='images/1439235663686851046.jpg' width='316'
                                                              height='170'
                                                              border='0'/></a></li>
                    <li class=""><a href='affiche.php?ad_id=7&amp;uri=https%3A%2F%2Fshop115008598.taobao.com%2F'
                                    target='_blank'><img src='images/1439235680072464326.jpg' width='316'
                                                         height='170'
                                                         border='0'/></a></li>
                    <li class=""><a href='affiche.php?ad_id=8&amp;uri=https%3A%2F%2Fshop115008598.taobao.com%2F'
                                    target='_blank'><img src='images/1439235672175247984.jpg' width='316'
                                                         height='170'
                                                         border='0'/></a></li>
                </ul>
            </div>
        </div>

    </div>

    <div class="home-star-goods xm-carousel-container">
        <div class="xm-plain-box J_starGoodsCarousel">
            <div class="box-hd">
                <h2 class="title">
                    小米明星单品
                </h2>
                <div class="more">
                    <div class="xm-controls xm-controls-line-small xm-carousel-controls">
                        <a class="control control-prev iconfont" href="javascript: void(0);"></a>
                        <a class="control control-next iconfont" href="javascript: void(0);"></a>
                    </div>
                </div>
            </div>
            <div class="box-bd">
                <div class="xm-carousel-wrapper J_carouselWrap">
                    <ul class="xm-carousel-list xm-carousel-col-5-list goods-list rainbow-list clearfix J_carouselList">
                        <li class="rainbow-item-1">
                            <a class="thumb" href="goods.php?id=27" target="_blank">
                                <img src="images/goods.jpg"/>
                            </a>
                            <h3 class="title">
                                <a href="goods.php?id=27" target="_blank">小米电视2 40英寸</a>
                            </h3>
                            <p class="desc">40/49/55英寸 现货购买</p>
                            <p class="price">

                                2200<em>元</em>
                            </p>
                        </li>
                        <li class="rainbow-item-2">
                            <a class="thumb" href="goods.php?id=45" target="_blank">
                                <img src="images/goods.jpg"/>
                            </a>
                            <h3 class="title">
                                <a href="goods.php?id=45" target="_blank">小米活塞耳机标准版</a>
                            </h3>
                            <p class="desc"></p>
                            <p class="price">

                                89<em>元</em>
                            </p>
                        </li>
                        <li class="rainbow-item-3">
                            <a class="thumb" href="goods.php?id=31" target="_blank">
                                <img src="images/goods.jpg"/>
                            </a>
                            <h3 class="title">
                                <a href="goods.php?id=31" target="_blank">小米移动电源10000mAh</a>
                            </h3>
                            <p class="desc">松下/LG高密度进口电芯</p>
                            <p class="price">

                                79<em>元</em>
                            </p>
                        </li>
                        <li class="rainbow-item-4">
                            <a class="thumb" href="goods.php?id=40" target="_blank">
                                <img src="images/goods.jpg"/>
                            </a>
                            <h3 class="title">
                                <a href="goods.php?id=40" target="_blank">小米体重秤</a>
                            </h3>
                            <p class="desc"></p>
                            <p class="price">

                                99<em>元</em>
                            </p>
                        </li>
                        <li class="rainbow-item-5">
                            <a class="thumb" href="goods.php?id=32" target="_blank">
                                <img src="images/goods.jpg"/>
                            </a>
                            <h3 class="title">
                                <a href="goods.php?id=32" target="_blank">小米路由器 mini</a>
                            </h3>
                            <p class="desc">主流双频AC智能路由器，性价比之王</p>
                            <p class="price">

                                129<em>元</em>
                            </p>
                        </li>
                        <li class="rainbow-item-6">
                            <a class="thumb" href="goods.php?id=41" target="_blank">
                                <img src="images/goods.jpg"/>
                            </a>
                            <h3 class="title">
                                <a href="goods.php?id=41" target="_blank">小米移动电源16000mAh</a>
                            </h3>
                            <p class="desc"></p>
                            <p class="price">

                                109<em>元</em>
                            </p>
                        </li>
                        <li class="rainbow-item-7">
                            <a class="thumb" href="goods.php?id=33" target="_blank">
                                <img src="images/goods.jpg"/>
                            </a>
                            <h3 class="title">
                                <a href="goods.php?id=33" target="_blank">小蚁智能摄像机 标准</a>
                            </h3>
                            <p class="desc">能看能听能说，手机远程观看</p>
                            <p class="price">

                                129<em>元</em>
                            </p>
                        </li>
                        <li class="rainbow-item-8">
                            <a class="thumb" href="goods.php?id=42" target="_blank">
                                <img src="images/goods.jpg"/>
                            </a>
                            <h3 class="title">
                                <a href="goods.php?id=42" target="_blank">小米蓝牙手柄</a>
                            </h3>
                            <p class="desc"></p>
                            <p class="price">

                                99<em>元</em>
                            </p>
                        </li>
                        <li class="rainbow-item-9">
                            <a class="thumb" href="goods.php?id=34" target="_blank">
                                <img src="images/goods.jpg"/>
                            </a>
                            <h3 class="title">
                                <a href="goods.php?id=34" target="_blank">小蚁运动相机</a>
                            </h3>
                            <p class="desc">边玩边录边拍，手机随时分享</p>
                            <p class="price">

                                399<em>元</em>
                            </p>
                        </li>
                        <li class="rainbow-item-10">
                            <a class="thumb" href="goods.php?id=104" target="_blank">
                                <img src="images/201509/thumb_img/104_thumb_G_1441747447591.jpg"/>
                            </a>
                            <h3 class="title">
                                <a href="goods.php?id=104" target="_blank">课程</a>
                            </h3>
                            <p class="desc"></p>
                            <p class="price">

                                80<em>元</em>
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="video" class="home-video-box xm-plain-box J_itemBox J_videoBox is-visible">
            <div class="box-hd"><h2 class="title">视频</h2></div>
            <div class="box-bd J_brickBd">
                <ul class="video-list clearfix">
                    <li class="video-item video-item-first">
                        <div class="figure figure-img">
                            <a href="javascript:void(0)" data-video="http://player.youku.com/embed/XODcyMjA1MTQw">
                                <img src="themes/xiaomi/images/v-face1.jpg" width="296" height="180"><span class="play"><i
                                    class="iconfont"></i></span>
                            </a>
                        </div>
                        <h3 class="title"><a href="javascript:void(0)">小米空气净化器空气实验室</a></h3>
                        <p class="desc">空气净化器有用吗？看了就知道！</p>
                    </li>

                    <li class="video-item">
                        <div class="figure figure-img">
                            <a href="javascript:void(0)" data-video="http://player.youku.com/embed/XMTMwODUxNzAwMA==">
                                <img src="themes/xiaomi/images/v-face2.jpg" width="296" height="180"><span class="play"><i
                                    class="iconfont"></i></span>
                            </a>
                        </div>
                        <h3 class="title"><a href="javascript:void(0)">60秒看懂小米Note有多酷</a></h3>
                        <p class="desc">美女超模出演小米Note旗舰新品超炫广告</p>
                    </li>

                    <li class="video-item">
                        <div class="figure figure-img">
                            <a href="javascript:void(0)" data-video="http://player.youku.com/embed/XMTI1NTI5NzM4MA">
                                <img src="themes/xiaomi/images/v-face3.jpg" width="296" height="180"><span class="play"><i
                                    class="iconfont"></i></span>
                            </a>
                        </div>
                        <h3 class="title"><a href="javascript:void(0)">安卓机皇 小米Note顶配版</a></h3>
                        <p class="desc">顶级工艺，性能王者，艺术与科技的高度融合</p>
                    </li>

                    <li class="video-item">
                        <div class="figure figure-img">
                            <a href="javascript:void(0)" data-video="http://player.youku.com/embed/XMTMxMTY2MDY2NA==">
                                <img src="themes/xiaomi/images/v-face4.jpg" width="296" height="180"><span class="play"><i
                                    class="iconfont"></i></span>
                            </a>
                        </div>
                        <h3 class="title"><a href="javascript:void(0)">小米Note发布会全程视频</a></h3>
                        <p class="desc">一起见证安卓机皇的诞生</p>
                    </li>
                </ul>
            </div>
        </div>
        <div id="J_modalVideo" class="modal modal-video fade modal-hide">
            <div class="modal-hd">
                <h3 class="title"></h3>
                <a class="close"><i class="iconfont"></i></a>
            </div>
            <div class="modal-bd">
                <iframe width="880" height="536" src="" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>

    </div>
</div>
<div class="page-main home-main">
    <div class="container">
        <div class="home-brick-box home-brick-row-2-box xm-plain-box J_itemBox J_brickBox is-visible loaded">
            <div class="box-hd">
                <h2 class="title">路由器与智能硬件</h2>
                <div class="more J_brickNav">
                    <a class="more-link" href="category.php?id=80" style=" display:inline-block;">
                        查看全部<i class="iconfont"></i>
                    </a>
                    <ul class="tab-list J_brickTabSwitch">
                        <li class="tab-active">热门</li>
                        <li>小米手环</li>
                        <li>智能灯泡</li>
                        <li>摄像机</li>
                        <li>智能家庭套装</li>
                    </ul>
                </div>
            </div>
            <div class="box-bd J_brickBd">
                <div class="row">
                    <div class="span4 span-first">
                        <ul class="brick-promo-list clearfix">
                            <li class="brick-item brick-item-l">
                                <a target="_blank"
                                   href="affiche.php?ad_id=16&amp;uri=https%3A%2F%2Fshop115008598.taobao.com%2F"> <img
                                        src="images/1449710786109632841.jpg" width="234" height="614"/> </a>
                            </li>
                        </ul>

                    </div>
                    <div class="span16">


                        <ul class="brick-list clearfix">
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=35">
                                        <img src="images/goods.jpg" width="160"
                                             height="160" alt="小米空气净化器">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=35">小米空气净化器</a>
                                </h3>
                                <p class="desc"></p>
                                <p class="price">
                                    899<em>元</em></p>
                                <p class="rank">1人评价</p>
                                <div class="review-wrapper">
                                    <a href="javascript:void(0)">
                                        <span class="review"> 很好，很不错！</span>
                                        <span class="author"> 来自于 aaa 的评价 </span>
                                    </a>
                                </div>
                            </li>
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=40">
                                        <img src="images/goods.jpg" width="160"
                                             height="160" alt="小米体重秤">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=40">小米体重秤</a>
                                </h3>
                                <p class="desc"></p>
                                <p class="price">
                                    99<em>元</em></p>
                                <p class="rank">2人评价</p>
                                <div class="review-wrapper">
                                    <a href="javascript:void(0)">
                                        <span class="review"> 非常好的宝贝！</span>
                                        <span class="author"> 来自于 aaa 的评价 </span>
                                    </a>
                                </div>
                            </li>
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=32">
                                        <img src="images/goods.jpg" width="160"
                                             height="160" alt="小米路由器 mini">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=32">小米路由器 mini</a>
                                </h3>
                                <p class="desc">主流双频AC智能路由器，性价比之王</p>
                                <p class="price">
                                    129<em>元</em></p>
                                <p class="rank">0人评价</p>
                            </li>
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=33">
                                        <img src="images/goods.jpg" width="160"
                                             height="160" alt="小蚁智能摄像机 标准">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=33">小蚁智能摄像机 标准</a>
                                </h3>
                                <p class="desc">能看能听能说，手机远程观看</p>
                                <p class="price">
                                    129<em>元</em></p>
                                <p class="rank">0人评价</p>
                            </li>
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=34">
                                        <img src="images/goods.jpg" width="160"
                                             height="160" alt="小蚁运动相机">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=34">小蚁运动相机</a>
                                </h3>
                                <p class="desc">边玩边录边拍，手机随时分享</p>
                                <p class="price">
                                    399<em>元</em></p>
                                <p class="rank">0人评价</p>
                            </li>
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=104">
                                        <img src="images/201509/thumb_img/104_thumb_G_1441747447591.jpg" width="160"
                                             height="160" alt="课程">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=104">课程</a>
                                </h3>
                                <p class="desc"></p>
                                <p class="price">
                                    80<em>元</em></p>
                                <p class="rank">0人评价</p>
                            </li>
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=67">
                                        <img src="images/goods.jpg" width="160"
                                             height="160" alt="小米手环">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=67">小米手环</a>
                                </h3>
                                <p class="desc"></p>
                                <p class="price">
                                    69<em>元</em></p>
                                <p class="rank">0人评价</p>
                            </li>
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=65">
                                        <img src="images/goods.jpg" width="160"
                                             height="160" alt="全新小米路由器">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=65">全新小米路由器</a>
                                </h3>
                                <p class="desc">顶配企业级性能，最高内置6TB监控级硬盘</p>
                                <p class="price">
                                    699<em>元</em></p>
                                <p class="rank">0人评价</p>
                            </li>
                        </ul>


                        <ul class="brick-list clearfix">
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=67">
                                        <img src="images/goods.jpg" width="160"
                                             height="160" alt="">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=67">小米手环</a>
                                </h3>
                                <p class="desc"></p>
                                <p class="price">
                                    69<em>元</em></p>
                                <p class="rank">0人评价</p>
                            </li>
                        </ul>
                        <ul class="brick-list clearfix">
                        </ul>
                        <ul class="brick-list clearfix">
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=33">
                                        <img src="images/goods.jpg" width="160"
                                             height="160" alt="">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=33">小蚁智能摄像机 标准</a>
                                </h3>
                                <p class="desc">能看能听能说，手机远程观看</p>
                                <p class="price">
                                    129<em>元</em></p>
                                <p class="rank">0人评价</p>
                            </li>
                        </ul>
                        <ul class="brick-list clearfix">
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=42">
                                        <img src="images/goods.jpg" width="160"
                                             height="160" alt="">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=42">小米蓝牙手柄</a>
                                </h3>
                                <p class="desc"></p>
                                <p class="price">
                                    99<em>元</em></p>
                                <p class="rank">0人评价</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="home-brick-box home-brick-row-2-box xm-plain-box J_itemBox J_brickBox is-visible loaded">

            <div class="box-hd">
                <h2 class="title">耳机音箱与存储卡</h2>
                <div class="more J_brickNav">
                    <a class="more-link" href="category.php?id=101" style=" display:inline-block;">
                        查看全部<i class="iconfont"></i>
                    </a>
                    <ul class="tab-list J_brickTabSwitch">
                        <li class="tab-active">热门</li>
                        <li>小米头戴式耳机</li>
                        <li>音箱</li>
                        <li>品牌耳机</li>
                        <li>小米活塞耳机</li>
                    </ul>
                </div>
            </div>

            <div class="box-bd J_brickBd">
                <div class="row">
                    <div class="span4 span-first">
                        <ul class="brick-promo-list clearfix">
                            <li class="brick-item brick-item-m">
                                <a target="_blank"
                                   href="affiche.php?ad_id=19&amp;uri=https%3A%2F%2Fshop115008598.taobao.com%2F"> <img
                                        src="images/1439257211458415529.jpg" width="234" height="300"/> </a>
                            </li>
                            <li class="brick-item brick-item-m">
                                <a target="_blank"
                                   href="affiche.php?ad_id=20&amp;uri=https%3A%2F%2Fshop115008598.taobao.com%2F"> <img
                                        src="images/1439257230078103078.jpg" width="234" height="300"/> </a>
                            </li>
                        </ul>

                    </div>
                    <div class="span16">


                        <ul class="brick-list clearfix">
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=38">
                                        <img src="images/goods.jpg" width="160"
                                             height="160" alt="小米活塞耳机 炫彩版">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=38">小米活塞耳机 炫彩版</a>
                                </h3>
                                <p class="desc">适合出街的耳机</p>
                                <p class="price">
                                    39<em>元</em></p>
                                <p class="rank">7人评价</p>
                                <div class="review-wrapper">
                                    <a href="javascript:void(0)">
                                        <span class="review"> 跟女神版超配的。颜值高。</span>
                                        <span class="author"> 来自于 匿名用户 的评价 </span>
                                    </a>
                                </div>
                            </li>
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=45">
                                        <img src="images/goods.jpg" width="160"
                                             height="160" alt="小米活塞耳机标准版">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=45">小米活塞耳机标准版</a>
                                </h3>
                                <p class="desc"></p>
                                <p class="price">
                                    89<em>元</em></p>
                                <p class="rank">4人评价</p>
                                <div class="review-wrapper">
                                    <a href="javascript:void(0)">
                                        <span class="review"> 546456</span>
                                        <span class="author"> 来自于 匿名用户 的评价 </span>
                                    </a>
                                </div>
                            </li>
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=46">
                                        <img src="images/goods.jpg" width="160"
                                             height="160" alt="小钢炮蓝牙音箱">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=46">小钢炮蓝牙音箱</a>
                                </h3>
                                <p class="desc"></p>
                                <p class="price">
                                    129<em>元</em></p>
                                <p class="rank">0人评价</p>
                            </li>
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=101">
                                        <img src="images/201509/thumb_img/101_thumb_G_1441738730692.jpg" width="160"
                                             height="160" alt="中锘基B97S运动蓝牙耳机">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=101">中锘基B97S运动蓝牙耳机</a>
                                </h3>
                                <p class="desc"></p>
                                <p class="price">
                                    119<em>元</em></p>
                                <p class="rank">0人评价</p>
                            </li>
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=102">
                                        <img src="images/201509/thumb_img/102_thumb_G_1441738765271.jpg" width="160"
                                             height="160" alt="QCY 杰克J02蓝牙耳机">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=102">QCY 杰克J02蓝牙耳机</a>
                                </h3>
                                <p class="desc"></p>
                                <p class="price">
                                    97<em>元</em></p>
                                <p class="rank">0人评价</p>
                            </li>
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=64">
                                        <img src="images/goods.jpg" width="160"
                                             height="160" alt="魔声Beats Studio HD 2.0耳机">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=64">魔声Beats Studio HD 2.0耳机</a>
                                </h3>
                                <p class="desc">适用于 小米平板, 所有小米手机</p>
                                <p class="price">
                                    2699<em>元</em></p>
                                <p class="rank">0人评价</p>
                            </li>
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=59">
                                        <img src="images/goods.jpg" width="160"
                                             height="160" alt="小米方盒子蓝牙音箱">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=59">小米方盒子蓝牙音箱</a>
                                </h3>
                                <p class="desc"></p>
                                <p class="price">
                                    99<em>元</em></p>
                                <p class="rank">0人评价</p>
                            </li>
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=60">
                                        <img src="images/goods.jpg" width="160"
                                             height="160" alt="先锋APS-BA202蓝牙音箱">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=60">先锋APS-BA202蓝牙音箱</a>
                                </h3>
                                <p class="desc"></p>
                                <p class="price">
                                    229<em>元</em></p>
                                <p class="rank">0人评价</p>
                            </li>
                        </ul>


                        <ul class="brick-list clearfix">
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=30">
                                        <img src="images/goods.jpg" width="160"
                                             height="160" alt="">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=30">小米头戴式耳机</a>
                                </h3>
                                <p class="desc">50mm大尺寸航天金属振膜</p>
                                <p class="price">
                                    499<em>元</em></p>
                                <p class="rank">0人评价</p>
                            </li>
                        </ul>
                        <ul class="brick-list clearfix">
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=46">
                                        <img src="images/goods.jpg" width="160"
                                             height="160" alt="">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=46">小钢炮蓝牙音箱</a>
                                </h3>
                                <p class="desc"></p>
                                <p class="price">
                                    129<em>元</em></p>
                                <p class="rank">0人评价</p>
                            </li>
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=61">
                                        <img src="images/goods.jpg" width="160"
                                             height="160" alt="">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=61">Jam Blast蓝牙音箱</a>
                                </h3>
                                <p class="desc"></p>
                                <p class="price">
                                    299<em>元</em></p>
                                <p class="rank">0人评价</p>
                            </li>
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=60">
                                        <img src="images/goods.jpg" width="160"
                                             height="160" alt="">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=60">先锋APS-BA202蓝牙音箱</a>
                                </h3>
                                <p class="desc"></p>
                                <p class="price">
                                    229<em>元</em></p>
                                <p class="rank">0人评价</p>
                            </li>
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=59">
                                        <img src="images/goods.jpg" width="160"
                                             height="160" alt="">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=59">小米方盒子蓝牙音箱</a>
                                </h3>
                                <p class="desc"></p>
                                <p class="price">
                                    99<em>元</em></p>
                                <p class="rank">0人评价</p>
                            </li>
                        </ul>
                        <ul class="brick-list clearfix">
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=103">
                                        <img src="images/201509/thumb_img/103_thumb_G_1441738795942.jpg" width="160"
                                             height="160" alt="">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=103">铁三角COR150入耳式耳机</a>
                                </h3>
                                <p class="desc"></p>
                                <p class="price">
                                    139<em>元</em></p>
                                <p class="rank">0人评价</p>
                            </li>
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=102">
                                        <img src="images/201509/thumb_img/102_thumb_G_1441738765271.jpg" width="160"
                                             height="160" alt="">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=102">QCY 杰克J02蓝牙耳机</a>
                                </h3>
                                <p class="desc"></p>
                                <p class="price">
                                    97<em>元</em></p>
                                <p class="rank">0人评价</p>
                            </li>
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=101">
                                        <img src="images/201509/thumb_img/101_thumb_G_1441738730692.jpg" width="160"
                                             height="160" alt="">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=101">中锘基B97S运动蓝牙耳机</a>
                                </h3>
                                <p class="desc"></p>
                                <p class="price">
                                    119<em>元</em></p>
                                <p class="rank">0人评价</p>
                            </li>
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=100">
                                        <img src="images/201509/thumb_img/100_thumb_G_1441738698084.jpg" width="160"
                                             height="160" alt="">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=100">铁三角CLR100耳机</a>
                                </h3>
                                <p class="desc"></p>
                                <p class="price">
                                    178<em>元</em></p>
                                <p class="rank">0人评价</p>
                            </li>
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=99">
                                        <img src="images/201509/thumb_img/99_thumb_G_1441738667754.jpg" width="160"
                                             height="160" alt="">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=99">大波浪蓝牙耳机</a>
                                </h3>
                                <p class="desc"></p>
                                <p class="price">
                                    179<em>元</em></p>
                                <p class="rank">0人评价</p>
                            </li>
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=98">
                                        <img src="images/201509/thumb_img/98_thumb_G_1441738620606.jpg" width="160"
                                             height="160" alt="">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=98">铁三角J100耳机</a>
                                </h3>
                                <p class="desc"></p>
                                <p class="price">
                                    79<em>元</em></p>
                                <p class="rank">0人评价</p>
                            </li>
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=97">
                                        <img src="images/201509/thumb_img/97_thumb_G_1441738581513.jpg" width="160"
                                             height="160" alt="">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=97">先锋CL31系列入耳式耳机</a>
                                </h3>
                                <p class="desc"></p>
                                <p class="price">
                                    99<em>元</em></p>
                                <p class="rank">0人评价</p>
                            </li>
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=95">
                                        <img src="images/201509/thumb_img/95_thumb_G_1441738494824.jpg" width="160"
                                             height="160" alt="">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=95">先锋SE-MJ512折叠式头戴耳机</a>
                                </h3>
                                <p class="desc"></p>
                                <p class="price">
                                    168<em>元</em></p>
                                <p class="rank">0人评价</p>
                            </li>
                        </ul>
                        <ul class="brick-list clearfix">
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=38">
                                        <img src="images/goods.jpg" width="160"
                                             height="160" alt="">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=38">小米活塞耳机 炫彩版</a>
                                </h3>
                                <p class="desc">适合出街的耳机</p>
                                <p class="price">
                                    39<em>元</em></p>
                                <p class="rank">7人评价</p>
                                <div class="review-wrapper">
                                    <a href="javascript:void(0)">
                                        <span class="review"> 跟女神版超配的。颜值高。</span>
                                        <span class="author"> 来自于 匿名用户 的评价 </span>
                                    </a>
                                </div>
                            </li>
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="goods.php?id=45">
                                        <img src="images/goods.jpg" width="160"
                                             height="160" alt="">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="goods.php?id=45">小米活塞耳机标准版</a>
                                </h3>
                                <p class="desc"></p>
                                <p class="price">
                                    89<em>元</em></p>
                                <p class="rank">4人评价</p>
                                <div class="review-wrapper">
                                    <a href="javascript:void(0)">
                                        <span class="review"> 546456</span>
                                        <span class="author"> 来自于 匿名用户 的评价 </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
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
