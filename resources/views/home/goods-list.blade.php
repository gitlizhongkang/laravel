@extends('layouts.home-header')
  
@section('content')
<link href="css/category.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/xiaomi_category.js"></script>
<script type="text/javascript" src="js/global.js"></script>
<script type="text/javascript" src="js/compare.js"></script>
<script type="text/javascript" src="js/uri.js"></script>
<link href="css/point.css" rel="stylesheet" type="text/css" />
<!--通栏-->
<div class="breadcrumbs">
    <div class="container">
        <a href="{{URL::to('/')}}">首页</a> 
        <code>&gt;</code> <a href="javascript:;">商品列表</a>
    </div>
</div>

<!--分类-->
<div class="container">
    <div class="filter-box">
        <div class="filter-list-wrap">
            <dl class="filter-list clearfix filter-list-row-2">
                <dt>品牌：</dt>
                @if (empty($param['brand_name']))
                    <dd class="active">全部</dd>
                @else
                    <dd class="">全部</dd>
                @endif    
                @foreach ($brand as $k=>$v)
                    @if ($param['brand_name'] == $v['brand_name'])
                    <dd class="active">
                    @else
                    <dd class=''>
                    @endif 
                        <a href="javascript:;" class='brand_name'>{{$v['brand_name']}}</a>
                    </dd>
                   
                @endforeach
            </dl>
            <a  href="javascript:;" class="more J_filterToggle">更多<i class="iconfont"></i></a>
        </div>
        <div class="filter-list-wrap">
            <dl class="filter-list clearfix filter-list-row-3">
                <dt>价格：</dt>
                <dd class="active">请输入价格区间：</dd>
                <dd> 
                    <input type="text" id='price_min' style='width: 50px;color:#F08080' placeholder="最低价" value="{{$param['price_min']}}">   
                    &nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;
                    <input type="text" id='price_max' style='width: 50px;color:#F08080'  placeholder="最高价" value="{{$param['price_max']}}">
                </dd> 
            </dl>
        </div>
    </div>
</div>

<!--内容展示-->
<div class="content">
    <div class="container">
        <!--排序-->
        <div class="order-list-box clearfix">
            <form method="GET" name="listform" id='search'>
                <ul class="order-list">
                    @if (empty($param['order']))
                    <li class="first active">  
                    @else
                    <li class="first">                   
                    @endif                 
                        <a title="销量" href="javascript:;" class="curr price_order" rel="nofollow"  order=''>
                            <span class="search_DESC">销量</span>&nbsp;<i class="iconfont"></i>
                        </a>
                    </li>                    
                    @if ($param['order'] == 'down')
                    <li class="first active">
                    @else
                    <li class="">
                    @endif
                        <a title="价格" href="javascript:;"  rel="nofollow" class="price_order"  order='down'>
                            <span>价格</span>&nbsp;<i class="iconfont"></i>                           
                        </a>
                    </li>
                    @if ($param['order'] == 'up')
                    <li class="first active">
                    @else
                    <li class="">
                    @endif
                        <a title="价格" href="javascript:;"  rel="nofollow" class="price_order" order='up'>
                            <span >价格</span>&nbsp;<i style='font-family: "iconfont";-webkit-text-stroke-width: 0.2px;font-style: normal;'>↑</i>
                        </a>
                    </li>
                </ul>
            </form>
        </div>
        
        <script>
        //获取url参数值
        function GetQueryString(name) {
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
            var r = window.location.search.substr(1).match(reg);
            if (r != null) return decodeURI(r[2]); return null;
        } 
        
        //修改url参数值
        function changeUrl(par, par_value)
        {
            var sourceUrl = decodeURI(window.location);
            // 调用方法生成新的URL
            var newUrl = new Uri(sourceUrl).replaceQueryParam(par, par_value);

            return newUrl.toString();
        }

        //品牌
        $('.brand_name').click(function(){
            var brand_name = $(this).html();
            var par = GetQueryString('brand_name');

            if (par != brand_name) {
                location.href = changeUrl('brand_name',brand_name);
            }
        })

        //价格区间
        $('#price_max').blur(function(){
            var price_max = $(this).val();
            var price_min = $('#price_min').val();
            if(price_min == '') {
                alert('请输入最低价格！！！');
                return flase;
            } else if (price_max == '') {
                alert('请输入最高价格！！！');
                return flase;
            } else if (price_min < 0 || price_max < 0) {
                alert('请输入正确价格！！！');
                return flase;
            } else if (price_min > price_max) {
                alert('最低价不能高于最高价哦！！！');
                return flase;
            } else if (price_min == price_max) {
                alert('最低价不能等于最高价哦！！！');
                return flase;
            } else {   
                // 调用方法生成新的URL            
                var sourceUrl = changeUrl('price_min',price_min).toString();                
                var newUrl = new Uri(sourceUrl).replaceQueryParam('price_max', price_max);
                location.href = newUrl.toString();
            }

        })
        //价格排序
        $('.price_order').click(function(){
            var order = $(this).attr('order');
            var par = GetQueryString('order');

            if (par != order) {
                location.href = changeUrl('order',order);
            }
        })

        
        </script>
       
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
                            本店价：<font class="shop_s">{{$v['goods_low_price']}}<em>元</em></font>
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
                        <!-- <div class="flags">
                            <div class="flag flag-saleoff">8.4折促销</div>
                        </div> -->
                    </div>
                @endforeach
                <!-- <br> -->
                <!-- <div class="xm-pagers-wrapper">{!! $goods->appends($param)->render() !!}</div> -->
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
                {!! $goods->appends($param)->render() !!}
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
                    <li class="pager"><span class="dot">2</span></li>
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

