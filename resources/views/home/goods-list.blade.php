@extends('layouts.home-header')
  
@section('content')

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
@endsection


<!--脚部-->

