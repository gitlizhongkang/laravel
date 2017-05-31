@extends('layouts.home-header')
  
@section('content')
<link href="css/category.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/xiaomi_category.js"></script>
<script type="text/javascript" src="js/global.js"></script>
<script type="text/javascript" src="js/compare.js"></script>
<!--通栏-->
<div class="breadcrumbs">
    <div class="container">
        <a href="{{URL::to('/')}}">首页</a> 
        <code>&gt;</code> <a href="category.php?id=76">购买电视与平板</a>
    </div>
</div>

<!--分类-->
<div class="container">
    <div class="filter-box">
        <div class="filter-list-wrap">
            <dl class="filter-list clearfix filter-list-row-2">
                <dt>品牌：</dt>
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
                <li> <a href="javascript:;" onClick="javascript:display_mode('list')"><img src="images/display_mode_list.gif" alt=""></a></li>
                <li><a href="javascript:;" onClick="javascript:display_mode('grid')"><img src="images/display_mode_grid_act.gif" alt=""></a></li>
                <li><a href="javascript:;" onClick="javascript:display_mode('text')"><img src="images/display_mode_text.gif" alt=""></a></li>&nbsp;&nbsp;
            </ul>
        </div>

        <!--内容-->
        <form name="compareForm" action="compare.php" method="post" onSubmit="return compareGoods(this);">
            <div class="goods-list-box">
                <div class="goods-list clearfix">
                @if (isset($goods[0]))
                @foreach ($goods as $k=>$v)
                    <div class="goods-item">
                        <div class="figure figure-img">
                            <a href="home-goods-goodsInfo?goods_id={{$v['goods_id']}}"><img src="{{$v['goods_img']}}" alt="{{$v['goods_name']}}" class="goodsimg" /></a>
                        </div>
                        <p class="desc">{{$v['brand_name']}}</p>
                        <h2 class="title"><a href="home-goods-goodsInfo?goods_id={{$v['goods_id']}}" title="{{$v['goods_name']}}">{{$v['goods_name']}}</a></h2>
                        <p class="price">
                            本店价<font class="shop_s">{{$v['goods_low_price']}}<em>元</em></font>
                          <!--   <del>专柜价<font class="market_s">358<em>元</em></font></del> -->
                        </p>
                        <!-- <div class="thumbs J_attrImg">
                            <div style="width:212px;margin:0 auto;">
                                <ul class="thumb-list clearfix J_imgList">
                                    <li class="active" data-config='{figure:"images/goods.jpg"}'>
                                        <a><img src="images/goods.jpg" width="34" height="34"></a>
                                    </li>
                                </ul>
                            </div>
                        </div> -->
                        <!-- <div class="actions clearfix"> -->
                           <!--  <a href="javascript:addToCart(29)" class="btn-buy J_buyGoods"><span>加入购物车</span> <i class="iconfont"></i></a> -->
                        <!-- </div> -->
                        <div class="flags">
                            <div class="flag flag-saleoff">8.4折促销</div>
                        </div>
                    </div>
                @endforeach
                @else
                    <p>没有符合条件的商品！！！</p>
                @endif     
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
                    <div class="pagenav">{!! $goods->links() !!}</div>
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
                @foreach ($userLike as $k=>$v)
                    <li class="J_xm-recommend-list">
                        <dl>
                            <dt><a href="home-goods-goodsInfo?goods_id={{$v['goods_id']}}" target="_blank"><img src="{{$v['goods_img']}}" /></a></dt>
                            <dd class="xm-recommend-name"><a href="home-goods-goodsInfo?goods_id={{$v['goods_id']}}" target="_blank" title="{{$v['goods_name']}}">{{$v['goods_name']}}</a></dd>
                            <dd class="xm-recommend-price">{{$v['goods_low_price']}}<em>元</em></dd>
                            <dd class="xm-recommend-tips"> </dd>
                        </dl>
                    </li>   
                @endforeach                     
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

