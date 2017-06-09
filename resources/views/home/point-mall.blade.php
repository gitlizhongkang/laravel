@extends('layouts.home-header')

@section('content')
    <link href="css/category.css" rel="stylesheet" type="text/css" />
    <link href="css/point.css" rel="stylesheet" type="text/css" />
    <script>
        var category="<?php echo $data['param']['category']?>";
        var area="<?php echo $data['param']['area']?>";
        var order="<?php echo $data['param']['order']?>";
    </script>
    <script type="text/javascript" src="js/xiaomi_category.js"></script>
    <script type="text/javascript" src="js/point.js"></script>
    <script type="text/javascript" src="js/global.js"></script>
    <script type="text/javascript" src="js/compare.js"></script>
    <!--通栏-->
    <div class="breadcrumbs">
        <div class="container">
            <a href="{{URL::to('/')}}">首页</a>
            <code>&gt;</code> <a href="{{ URL::to("home-pointMall-index") }}">积分商城</a>
        </div>
    </div>

    <!--分类-->
    <div class="container">
        <div class="filter-box">
            <div class="filter-list-wrap">
                <dl class="filter-list clearfix filter-list-row-2 point-area">
                    <dt>积分范围</dt>
                    <dd><a href="javascript:;" area="">全部</a></dd>
                    <dd><a href="javascript:;" area="0-1000">0&nbsp;-&nbsp;1000</a></dd>
                    <dd><a href="javascript:;" area="1001-3000">1000&nbsp;-&nbsp;3000</a></dd>
                    <dd><a href="javascript:;" area="3001-5000">3000&nbsp;-&nbsp;5000</a></dd>
                    <dd><a href="javascript:;" area="5001-10000">5000&nbsp;-&nbsp;10000</a></dd>
                    <dd><a href="javascript:;" area="10001-999999">10000+</a></dd>
                </dl>
                <dl class="filter-list clearfix filter-list-row-2 category">
                    <dt>分类</dt>
                    <dd class="active"><a href="javascript:;" cName="">全部</a></dd>
                    @foreach ($data['categoryInfo'] as $v)
                        <dd class="active"><a href="javascript:;" cName="{{ $v->cName }}">{{$v->cName."(".$v->cCount.")"}}</a></dd>
                    @endforeach
                </dl>
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
                            <a title="默认排序" href="javascript:;" order="desc" class="curr" rel="nofollow">
                                <span class="search_DESC">默认排序</span>&nbsp;<i class="iconfont"></i>
                            </a>
                        </li>
                        <li class="first">
                            <a title="积分" href="javascript:;" order="asc" class="curr" rel="nofollow">
                                <span class="">积分</span> <i class="iconfont"></i>
                            </a>
                        </li>
                        <input type="hidden" name="category" value="{{ empty($data['param']['category'])?'':$data['param']['category'] }}" />
                        <input type="hidden" name="point_area" value="{{ empty($data['param']['area'])?'':$data['param']['area'] }}" />
                        <input type="hidden" name="page" value="1" />
                        <input type="hidden" name="order" value="{{ empty($data['param']['order'])?'':$data['param']['order'] }}" />
                    </ul>
                </form>
            </div>

            <!--内容-->

                <div class="goods-list-box">
                    <div class="goods-list clearfix">
                        @foreach($data['pointInfo'] as $v)
                        <div class="goods-item">
                            <div class="figure figure-img">
                                <a href='{{ URL::to("home-pointMall-info?goods_id=$v->gId") }}'><img src="{{ $v->gImg }}" alt="{{ $v->gName }}" class="goodsimg" /></a>
                            </div>
                            <h2 class="title"><a href="" title="{{$v->gName}}">{{$v->gName}}</a></h2>
                            <p class="price">
                                积分：<font class="shop_s">{{ $v->gPoint }}</font>
                            </p>
                        </div>
                        @endforeach
                    </div>
                    {{ $data['pointInfo']->links() }}
                </div>
        </div>

        {{--<div id="J_renovateWrap" class="xm-recommend-container container xm-carousel-container">--}}
            {{--<h2 class="xm-recommend-title"><span>为你推荐</span></h2>--}}
            {{--<div class="xm-recommend">--}}
                {{--<div class="xm-carousel-wrapper">--}}
                    {{--<ul class="xm-carousel-col-5-list xm-carousel-list clearfix">--}}
                        {{--<li class="J_xm-recommend-list">--}}
                            {{--<dl>--}}
                                {{--<dt><a href="goods.php?id=27" target="_blank"><img src="images/goods.jpg" /></a></dt>--}}
                                {{--<dd class="xm-recommend-name"><a href="goods.php?id=27" target="_blank" title="小米电视2 40英寸">小米电视2 40英寸</a></dd>--}}
                                {{--<dd class="xm-recommend-price">2200<em>元</em></dd>--}}
                            {{--</dl>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}


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

