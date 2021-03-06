 @extends('layouts.home-header')
<?php  
$user_id = Session::get('uid');
?>     
@section('content')
<!--通栏-->
<div class="breadcrumbs">
    <div class="container">
        <a href="{{URL::to('/')}}">首页</a> <code>&gt;</code>
        <a href="home-goods-index?category_id={{$goodsInfo['category_id']}}">{{$goodsInfo['category_name']}}</a> <code>&gt;</code>{{$goodsInfo['goods_name']}}
    </div>
</div>
<div class="goods-detail">
    <div class="goods-detail-info  clearfix J_goodsDetail">
        <div class="container">
            <div class="row">
                <div class="span13  J_mi_goodsPic_block goods-detail-left-info">
                    <div class="goods-pic-box" id="detail_img">
                        <div class="goods-big-pic">
                            <a href="" class="MagicZoomPlus" id="Zoomer" rel="hint-text: ; selectors-effect: false; selectors-class: current; zoom-distance: 60;zoom-width: 400; zoom-height: 400;" >
                                <img  alt="" src="{{$goodsInfo['goods_img']}}">
                            </a>
                        </div>
                        <div class="goods-small-pic" id="item-thumbs">
                            <a class="prev" href="javascript:void(0);"></a>
                            <a class="next" href="javascript:void(0);"></a>
                            <div class="bd">
                                <ul class="cle">
                                    @foreach ($img as $k=>$v) 
                                    <li class="current">
                                        <a href="" rel="zoom-id: Zoomer" rev="{{$v['img_url']}}">
                                            <img alt="" src="{{$v['img_url']}}">
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="span7 goods-info-rightbox">
                    <!-- <form action="" method="post" name="ECS_FORMBUY" id="ECS_FORMBUY" > -->


                        <div class="goods-info-box" id="item-info">
                            <dl class="loaded">
                                <dt class="goods-info-head">
                                <dl>
                                    <dt class="goods-name">{{$goodsInfo['goods_name']}}</dt>
                                    <dd class="goods-phone-type"><p> 现货购买</p></dd>
                                   <!--  <del>专柜价： <em class="cancel">{{$goodsInfo['goods_low_price']}}<em>元</em></em></del> -->
                                    <dd class="goods-info-head-price clearfix">
                                        @if(empty($goodsInfo['goods_point']))
                                        <span>本店价：</span> <span class="unit"> <b class="nala_price red" ><span id="ECS_SHOPPRICE">{{$goodsInfo['goods_low_price']}}</span><em>元</em> </b> </span>
                                        @else
                                            <span>需用积分：</span> <span class="unit"> <b class="nala_price red" ><span id="ECS_SHOPPRICE">{{$goodsInfo['goods_point']}}</span><em>分</em> </b> </span>
                                        @endif
                                    </dd>
                                    <dd class="goods-info-choose">
                                        <div id="choose" class="spec_list_box" len="{{count($norms)}}" sku-id='' sku-norms='' sku-num='' sku-img=''>
                                            <ul>
                                                @foreach ($norms as $k=>$v)
                                                <li  class="GeneralAttrImg">
                                                    <div class="dt">{{$v['norms_name']}}</div>
                                                    <div class="dd">
                                                     @foreach ($v['norms_value'] as $k1=>$v1)
                                                        <div class="item ">
                                                           <b></b>
                                                            <a href="javascript:;" title="" rel="zoom-id: Zoomer" rev="images/goods1.jpg"><span>{{$v1}}</span></a>
                                                            <input id="spec_value_81" style="display:none;" type="radio" name="norms{{$k}}" value="{{$v1}}" />                                                            
                                                        </div>
                                                     @endforeach
                                                    </div>
                                                </li>
                                                @endforeach                                            
                                            </ul>
                                        </div>
                                        <style>
                                            #choose{margin:0;}
                                            #choose li{overflow:hidden; padding-bottom:20px;}
                                            #choose .dt{width:72px; text-align:left; float:left; padding:6px 0 0;}
                                            #choose .dd{overflow:hidden;}
                                            #choose .dd .item{float:left; margin:2px 8px 2px 0; position:relative;}
                                            #choose .dd .item a{border:1px solid #ccc; padding:4px 6px; float:left;}
                                            #choose .dd .item a span{padding:0 3px; line-height:30px;}
                                            #choose .dd .item a img{width:30px; height:30px;}
                                            #choose .dd .item b{width:12px; height:12px; background:url(images/gou.png) no-repeat; position:absolute; bottom:1px; right:1px; overflow:hidden; display:none;}
                                            #choose .dd .item.selected a{border-width:2px; border-color:#e4393c; padding:3px 5px;}
                                            #choose .dd .item.selected b{display:block;}
                                            #choose li.GeneralAttrImg .dt{padding-top:10px;}
                                            #choose li.GeneralAttrImg .dd .item a{padding:1px;}
                                            #choose li.GeneralAttrImg .dd .item a img{margin:1px;}
                                            #choose li.GeneralAttrImg .dd .item.selected a{padding:0;}
                                        </style>

                                        <ul class="sku">
                                            <li class="skunum_li clearfix">
                                                <div class="ghd">数量：</div>
                                                <div class="skunum gbd" id="skunum">
                                                    <span class="minus" title="减少1个数量"></span>
                                                    <input id="number" name="number" type="text" min="1" value="1" onchange="">
                                                    <span class="add" title="增加1个数量"></span>&nbsp;件<br>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class='sku-num' style='color: red'></i>
                                                </div>
                                            </li>
                                        </ul>
                                    </dd>

                                    <dd class="goods-info-head-cart">
                                        @if(empty($goodsInfo['goods_point']))
                                        <a href="javascript:;" class="btn  btn-primary goods-add-cart-btn" id="buy_btn"><i class="iconfont"></i>加入购物车</a>
                                        @endif
                                        <a href="javascript:;" class=" btn btn-gray  goods-collect-btn " id="fav_btn"><i class="iconfont"></i>购买</a>                                        
                                    </dd>
                                    <dd class="goods-info-head-userfaq clearfix">
                                        <ul>
                                            <li class=""><i class="iconfont"></i> 销量 <b>1</b></li>
                                            <li class="J_scrollcomment mid"><i class="iconfont"></i> 评价 <b>{{$satisfaction['all']}}</b></li>
                                            <li class="J_scrollcomment"><i class="iconfont"></i> 满意度
                                                <b>@if($satisfaction['all'] != 0)
                                                        {{ceil($satisfaction['good']/$satisfaction['all']*100)}}
                                                    @else
                                                        0
                                                    @endif%
                                                </b></li>
                                        </ul>
                                    </dd>
                                </dl>
                                </dt>

                            </dl>
                        </div>
                    <!-- </form> -->
            </div>
        </div>
    </div>
        <script type="text/javascript">
          
        </script></div>
    <div class="full-screen-border"></div>
    <div class="goods-detail-main">
        <div class="goods-detail-nav" id="goodsDetail">
            <div class="container">
                <ul class="detail-list">
                    <li> <a class="J_scrollHref" rel="nofollow" href="javascript:void(0);">详情描述</a> </li>
                    <li> <a class="J_scrollHref" rel="nofollow" href="javascript:void(0);">规格参数</a> </li>
                    <li><a class="J_scrollHref" href="javascript:void(0);" rel="nofollow">评价晒单(<em>{{$satisfaction['all']}}</em>)</a></li>
                </ul>
            </div>
        </div>
        <div class="product_tabs">
            <div class="goods-detail-desc goods_con_item">
                <div class="container">
                    <div class="shape-container">
                        <?=$goodsInfo['goods_desc']?>
                    </div>
                </div>
            </div>

            <div class="goods-detail-nav-name-block goods_con_item">
                <div class="container main-block">
                    <div class="border-line"></div>
                    <h2 class="nav-name">规格参数</h2>
                </div>
            </div>
            <div class="goods-detail-param">
                <div class="container">
                    <ul class="param-list">
                        <li class="goods-img"><img src="{{$goodsInfo['goods_img']}}" alt="{{$goodsInfo['goods_name']}}" /></li>
                        <li class="goods-tech-spec">
                            <ul>
                                <li>品牌：</li>                               
                                <li>{{$goodsInfo['brand_name']}}</li>                              
                            </ul>                           
                        </li>
                        @foreach ($goodsAttr as $k=>$v)
                        <li class="goods-tech-spec">
                            <ul>
                                <li>{{$v['attr_name']}}：</li>                               
                                @foreach ($v['attr_value'] as $k1=>$v1)
                                <li>{{$v1}}</li>
                                @endforeach
                                
                            </ul>                           
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="goods-detail-nav-name-block goods_con_item">
                <div class="container main-block">
                    <div class="border-line"></div>
                    <h2 class="nav-name">评价晒单</h2>
                </div>
            </div>
            <div class="goods-detail-comment hasContent z-com-box-head">
                <div id="ECS_COMMENT">
                    <div class="goods-detail-comment-groom" style="border-width:0 0 1px 0">
                        <div class="container">
                            <ul class="main-block clearfix">
                                <li class="percent">
                                    <div class="per-num"><i>
                                            @if($satisfaction['all'] != 0)
                                                {{ceil($satisfaction['good']/$satisfaction['all']*100)}}
                                            @else
                                                0
                                            @endif
                                        </i>%</div>
                                    <div class="per-title">购买后满意</div>
                                    <div class="per-amount"><i>{{$satisfaction['all']}}</i>名用户投票</div>
                                </li>
                                <li>
                                    <ul class="z-point-list" id="min_points">
                                        <li>
                                            <label>好评：</label>
                                            <p> <span style="width: @if($satisfaction['all'] != 0){{ceil($satisfaction['good']/$satisfaction['all']*100)}}@else 0 @endif%;"></span> </p>
                                            <em>@if($satisfaction['all'] != 0)
                                                    {{ceil($satisfaction['good']/$satisfaction['all']*100)}}
                                                @else
                                                    0
                                                @endif%</em> </li>
                                        <li>
                                            <label>中评：</label>
                                            <p> <span style="width:@if($satisfaction['all'] != 0) {{ceil($satisfaction['commonly']/$satisfaction['all']*100)}}@else 0 @endif%;"></span> </p>
                                            <em>@if($satisfaction['all'] != 0)
                                                    {{ceil($satisfaction['commonly']/$satisfaction['all']*100)}}
                                                @else
                                                    0
                                                @endif%</em> </li>
                                        <li>
                                            <label>差评：</label>
                                            <p> <span style="width:@if($satisfaction['all'] != 0) {{ceil($satisfaction['bad']/$satisfaction['all']*100)}}@else 0 @endif%;"></span> </p>
                                            <em>@if($satisfaction['all'] != 0)
                                                    {{100-ceil($satisfaction['commonly']/$satisfaction['all']*100)-ceil($satisfaction['good']/$satisfaction['all']*100)}}
                                                @else
                                                    0
                                                @endif%</em> </li>
                                    </ul>
                                </li>
                                <li class="i-want-comment">
                                    <div>对自己购买过的商品进行评价，它将成为大家购买参考依据。</div>
                                    <div class="good_com_box">
                                        所有用户都可以对该商品 <a href="javascript:void(0);" onClick="commentsFrom()" id="go_com" class="btn btn-primary">我要评价</a>

                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="goods-detail-comment-content">
                        <div class="container">
                            <div class="row">
                                <div class="span20 goods-detail-comment-list">
                                    <div class="comment-order-title">
                                        <div class="left-title"><h3 class="comment-name">最有帮助的评价 </h3></div>
                                        <div class="right-title J_showImg"><i class="iconfont">√</i> 只显示带图评价</div>
                                    </div>
                                    @if (!empty($comment))
                                    <ul class="comment-box-list">
                                        @foreach ($comment as $k=>$v)
                                        <li class="item-rainbow-1">
                                            <div class="user-image"> <img class="face_img" src="images/goods1.jpg"> </div>
                                            @if($v['satisfaction'] == 5)
                                            <div class="user-emoj">
                                                超爱<i class="iconfont"></i>
                                            </div>
                                            @elseif($v['satisfaction'] == 4)
                                            <div class="user-emoj">
                                                满意<i class="iconfont"></i>
                                            </div>
                                            @elseif($v['satisfaction'] == 3)
                                            <div class="user-emoj">
                                                一般<i class="iconfont"></i>
                                            </div>
                                            @elseif($v['satisfaction'] == 2)
                                            <div class="user-emoj">
                                                不满意<i class="iconfont"></i>
                                            </div>
                                            @elseif($v['satisfaction'] == 1)
                                            <div class="user-emoj">
                                                很失望<i class="iconfont"></i>
                                            </div>
                                            @endif
                                            <div class="user-name-info">
                                                <span class="user-name">{{$v['user_id']}}</span>
                                                <span class="user-time">{{date('Y-m-d h:i:s',$v['add_time'])}}</span>
                                                <span class="pro-info"></span>
                                            </div>
                                            <dl class="user-comment">
                                                <dt class="user-comment-content"><p class="content-detail">{{$v['comment_desc']}}</p>
                                                @if(!empty($v['comment_img']))
                                                    <?php $arr = explode(',',$v['comment_img']);?>
                                                    @foreach($arr as $val)
                                                            <span class="content-detail" style="margin-left: 20px"><img src="{{$val}}" width="100px" alt=""></span>
                                                    @endforeach
                                                @endif
                                                </dt>
                                                <dd class="user-comment-self-input hide">
                                                    <div class="input-block"><input type="text" placeholder="回复楼主" class="J_commentAnswerInput"><a href="javascript:void(0);" class="btn  answer-btn J_commentAnswerBtn">回复</a></div>
                                                </dd>
                                            </dl>
                                        </li>
                                        @endforeach
                                    </ul>
                                     <a href="home-goods-comment?goods_id={{$goodsInfo['goods_id']}}" class="btn  btn-primary ">查看更多</a>
                                    @else
                                       <p>该商品暂无评价</p>
                                    @endif  
                                    <hr>     
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="z-com-box-head">

                        <div class="z-com-list" id="ECS_COMMENT">


                            <div id="compage">

                            </div>
                        </div>
                        <script type="Text/Javascript" language="JavaScript">
                            <!--

                            function selectPage(sel)
                            {
                                sel.form.submit();
                            }

                            //-->
                        </script>


                        <div id="commentsFrom">
                            <form action="home-goods-addComment" method="post" enctype="multipart/form-data"  name="commentForm" id="commentForm">
                                <ul class="form addr-form" id="addr-form">
                                    <span style="position:absolute; right:10px; top:5px; font-size:24px; cursor:pointer;" onClick="easyDialog.close();">×</span>
                                    <li>
                                        <label>用户名</label>
                                        {{Session::get('username')}}
                                    </li>
                                    <li>
                                        <label>评价等级</label>
                                        <input name="comment_rank" type="radio" value="1" id="comment_rank1" />
                                        <img src="images/stars1.gif" />
                                        <input name="comment_rank" type="radio" value="2" id="comment_rank2" />
                                        <img src="images/stars2.gif" />
                                        <input name="comment_rank" type="radio" value="3" id="comment_rank3" />
                                        <img src="images/stars3.gif" />
                                        <input name="comment_rank" type="radio" value="4" id="comment_rank4" />
                                        <img src="images/stars4.gif" />
                                        <input name="comment_rank" type="radio" value="5" id="comment_rank5" />
                                        <img src="images/stars5.gif" />
                                    </li>
                                    <li>
                                        <label>评论内容</label>
                                        <textarea name="content" class="txt" style="height:80px; width:300px;"></textarea>
                                    </li>
                                    <li>
                                        <label style="text-align: center;">晒图</label>
                                        <!-- 商品相册 -->
                                        <img class="img" src="" width="100" height="100" style="display: none;margin-left: 20px" border="0"><input type="file" name="image_url[]" style="display:none;" >
                                        <a href="javascript:void(0)" class="copy">[ + ]</a>
                                    </li>
                                    <li>
                                        <input type="hidden" name="id" value="{{$_GET['goods_id']}}" />
                                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                                        <input type="hidden" name="uid" value="{{$user_id or ''}}" />
                                        <label>&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                        <input name="" type="button"  value="提交评论" class="btn addComment" style="border:none; height:40px; cursor:pointer; width:150px; font-size:16px;">
                                    </li>
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="goods-sub-bar" id="goodsSubBar">
        <div class="container">
            <ul class="detail-list">
                <li> <a class="J_scrollHref" rel="nofollow" href="javascript:void(0);">详情描述</a> </li>
                <li> <a class="J_scrollHref" rel="nofollow" href="javascript:void(0);">规格参数</a> </li>
                <li><a class="J_scrollHref" href="javascript:void(0);" name="pjxqitem" rel="nofollow">评价晒单(<em>{{$satisfaction['all']}}</em>)</a></li>
            </ul>
            <dl class="goods-sub-bar-info clearfix">
                <dt><img src="images/goods.jpg" alt="" /></dt>
                <dd>
                    <strong>{{$goodsInfo['goods_name']}}</strong>
                    <p><em></em></p>
                </dd>
            </dl>
            <a href="javascript:;" class="btn btn-primary goods-add-cart-btn"><i class="iconfont"></i> 加入购物车</a>
        </div>
    </div>

    <div class="add_ok" id="cart_show">
        <div class="tip">
            <i class="iconfont"> </i>商品已成功加入购物车
        </div>
        <div class="go">
            <a href="home-goods-goodsInfo?goods_id={{$goodsInfo['goods_id']}}" class="back">&lt;&lt;继续购物</a>
            <a href="home-cart-index" class="btn">去结算</a>
        </div>
    </div>
</div>
<script src="js/jquery.wallform.js"></script>
<script src="js/goods.js"></script>
<script>
    $('.goods-add-cart-btn').click(function(){
        var sku_id =  $('#choose').attr('sku-id');
        if (sku_id == '') {
            alert('您还没有选择规格哦！！！');
            return false;
        }

        var num = $('#number').val();
        var sku_num = $('#choose').attr('sku-num');
        if (parseInt(sku_num) < num) {
            alert('库存不足');
            return false;
        }

        var user_id =  $("input[name='uid']").val();
        if(user_id =='') {
            if (!confirm('您还没有登录，添加购物车将只保存一次哦！')){
                return false;
            }
        }
        var sku_price = $('#ECS_SHOPPRICE').html();
        var sku_norms =  $('#choose').attr('sku-norms');
        var sku_img =  $('#choose').attr('sku-img');
        $.ajax({
            type:'post',
            url:'home-cart-add',
            data:{
                sku_id:sku_id,
                num:num,
                category_id:"{{$goodsInfo['category_id']}}",
                goods_id:"{{$goodsInfo['goods_id']}}",
                goods_name:"{{$goodsInfo['goods_name']}}",
                sku_price:sku_price,
                sku_norms:sku_norms,
                sku_img:sku_img,
                _token:"{{csrf_token()}}"
            },
            dataType:'json',
            success:function(msg){
                if(msg.error == 0) {
                    easyDialog.open({
                        container : 'cart_show'
                    });
                }
            }
        })

    })

    //直接购买
    $('.goods-collect-btn').click(function(){
        var sku_id =  $('#choose').attr('sku-id');
        var goods_id =  $("input[name='id']").val();
        if (sku_id == '') {
            alert('您还没有选择规格哦！！！');
            return false;
        }

        var num = $('#number').val();
        var sku_num = $('#choose').attr('sku-num');
        if (parseInt(sku_num) < num) {
            alert('库存不足');
            return false;
        }

        var user_id = $("input[name='uid']").val();
        if(user_id =='') {
            if (confirm('请先登陆！')){
                location.href = "home-user-login?URL=home-goods-goodsInfo?goods_id="+goods_id;
            } else {
                return false;
            }
        }
        if ("{{$goodsInfo['goods_point']}}" == '') {
            location.href = "home-order?sku="+sku_id+"&num="+num+"&type=direct";
        } else {
            location.href = "home-order?sku="+sku_id+"&num="+num+"&type=integral";
        }

    })
</script>
@endsection


<!--脚部-->
