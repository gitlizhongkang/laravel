@extends('layouts.home-header')
  
@section('content')
<div class="home-hero-container container">
    <div class="home-hero">
        <div class="home-hero-slider">
            <div id="J_homeSlider" class="xm-slider" style="overflow:hidden;">
                <div class="xm-slider-container">
                    <div class="xm-slider-control">
                        <div class="slide xm-slider-slide">
                            <a target="_blank" href="http://note.sdufa.com/goods.php?id=35">
                                <img src="images/lun1.jpg"/>
                            </a>
                        </div>
                        <div class="slide xm-slider-slide">
                            <a target="_blank" href="http://note.sdufa.com/goods.php?id=54">
                                <img src="images/lun2.jpg"/>
                            </a>
                        </div>
                        <div class="slide xm-slider-slide">
                            <a target="_blank" href="http://note.sdufa.com/goods.php?id=56">
                                <img src="images/lun1.jpg"/>
                            </a>
                        </div>
                        <div class="slide xm-slider-slide">
                            <a target="_blank" href="http://">
                                <img src="images/lun2.jpg"/>
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
                            <i class="iconfont"></i>秒杀商品
                        </a>
                    </li>
                    <li>
                        <a href="group_buy.php">
                            <i class="iconfont"></i>促销商品
                        </a>
                    </li>
                    <li>
                        <a href="exchange.php">
                            <i class="iconfont"></i>积分商城
                        </a>
                    </li>
                    <li>
                        <a href="snatch.php">
                            <i class="iconfont"></i>进口商品
                        </a>
                    </li>
                    <li>
                        <a href="brand.php">
                            <i class="iconfont"></i>品牌商品
                        </a>
                    </li>
                    <li>
                        <a href="brand.php">
                            <i class="iconfont"></i>国产商品
                        </a>
                    </li>
                </ul>
            </div>
            <!-- 直播预告 start -->
            <div class="span16">
                <ul class="home-promo-list clearfix">
                    <li class="first">
                        <a href='' target='_blank'>
                            <img src='images/goods.jpg' width='316' height='170' border='0'/>
                        </a>
                    </li>
                     <li class="first">
                        <a href='' target='_blank'>
                            <img src='images/goods.jpg' width='316' height='170' border='0'/>
                        </a>
                    </li>
                     <li class="first">
                        <a href='' target='_blank'>
                            <img src='images/goods.jpg' width='316' height='170' border='0'/>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- 直播预告 end -->
        </div>

    </div>

    <div class="home-star-goods xm-carousel-container">
        <div class="xm-plain-box J_starGoodsCarousel">
            <div class="box-hd">
                <h2 class="title">
                    猜你喜欢
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
                        @foreach ($recommendation as $k=>$v)
                        <li class="rainbow-item-1">
                            <a class="thumb" href="home-goods-goodsInfo?goods_id={{$v['goods_id']}}" target="_blank">
                                <img src="images/goods.jpg"/>
                            </a>
                            <h3 class="title">
                                <a href="home-goods-goodsInfo?goods_id={{$v['goods_id']}}" target="_blank">{{$v['goods_name']}}</a>
                            </h3>
                            <p class="desc">{{$v['category_name']}}</p>
                            <p class="price">
                               {{$v['goods_low_price']}}<em>元</em>
                            </p>
                        </li>
                        @endforeach
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
                                <img src="images/v-face1.jpg" width="296" height="180"><span class="play"><i
                                    class="iconfont"></i></span>
                            </a>
                        </div>
                        <h3 class="title"><a href="javascript:void(0)">小米空气净化器空气实验室</a></h3>
                        <p class="desc">空气净化器有用吗？看了就知道！</p>
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
                <h2 class="title">最新商品</h2>
                <div class="more J_brickNav">
                    <a class="more-link" href="home-goods-index" style=" display:inline-block;">
                        查看全部<i class="iconfont"></i>
                    </a>
                </div>
            </div>
            <div class="box-bd J_brickBd">
                <div class="row">
                    <div class="span4 span-first">
                        <ul class="brick-promo-list clearfix">
                            <li class="brick-item brick-item-l">
                                <a target="_blank" href=""> 
                                <img src="images/1449710786109632841.jpg" width="234" height="614"/> </a>
                            </li>
                        </ul>

                    </div>
                    <div class="span16">
                        <ul class="brick-list clearfix">
                            @foreach ($new as $k=>$v)
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="home-goods-goodsInfo?goods_id={{$v['goods_id']}}">
                                        <img src="images/goods.jpg" width="160"
                                             height="160" alt="小米空气净化器">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="home-goods-goodsInfo?goods_id={{$v['goods_id']}}">{{$v['goods_name']}}</a>
                                </h3>
                                <p class="desc"></p>
                                <p class="price">
                                   {{$v['goods_low_price']}}<em>元</em></p>
                                <p class="rank">商品描述</p>
                                <div class="review-wrapper">
                                    <a href="javascript:void(0)">
                                        <span class="review">{{$v['brand_name']}} </span>
                                        <span class="author"> </span>
                                    </a>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
       <div class="container">
        <div class="home-brick-box home-brick-row-2-box xm-plain-box J_itemBox J_brickBox is-visible loaded">
            <div class="box-hd">
                <h2 class="title">秒杀商品</h2>
                <div class="more J_brickNav">
                    <a class="more-link" href="home-goods-index" style=" display:inline-block;">
                        查看全部<i class="iconfont"></i>
                    </a>
                </div>
            </div>
            <div class="box-bd J_brickBd">
                <div class="row">
                    <div class="span4 span-first">
                        <ul class="brick-promo-list clearfix">
                            <li class="brick-item brick-item-l">
                                <a target="_blank" href=""> 
                                <img src="images/1449710786109632841.jpg" width="234" height="614"/> </a>
                            </li>
                        </ul>

                    </div>
                    <div class="span16">
                        <ul class="brick-list clearfix">
                            @foreach ($second as $k=>$v)
                            <li class="brick-item brick-item-m">
                                <div class="figure figure-img">
                                    <a href="home-goods-goodsInfo?goods_id={{$v['goods_id']}}">
                                        <img src="images/goods1.jpg" width="160"
                                             height="160" alt="">
                                    </a>
                                </div>
                                <h3 class="title">
                                    <a href="home-goods-goodsInfo?goods_id={{$v['goods_id']}}">{{$v['goods_name']}}</a>
                                </h3>
                                <p class="desc"></p>
                                <p class="price">
                                   {{$v['goods_low_price']}}<em>元</em></p>
                                <p class="rank">商品描述</p>
                                <div class="review-wrapper">
                                    <a href="javascript:void(0)">
                                        <span class="review">{{$v['goods_desc']}} </span>
                                        <span class="author"> </span>
                                    </a>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection



<!--脚部-->
