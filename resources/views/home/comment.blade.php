@extends('layouts.home-header')
     
@section('content')

  <div class="goods-detail-comment-content">
    <div class="container">
        <div class="row">
            <div class="span20 goods-detail-comment-list">
                <div class="comment-order-title">

                    <div class="left-title"><h3 class="comment-name"> <a href="home-goods-goodsInfo?goods_id={{$goods_id}}" class=" btn btn-gray  goods-collect-btn " id="fav-btn">返回</a> </h3></div>
                    <!-- <div class="right-title J_showImg"><i class="iconfont">√</i> 只显示带图评价</div> -->
                </div>
                <ul class="comment-box-list">
                    @foreach ($comment as $k=>$v)
                    <li class="item-rainbow-1">
                        <div class="user-image"> <img class="face_img" src="images/goods1.jpg"> </div>
                        <div class="user-emoj">
                           <!--  超爱<i class="iconfont"></i> -->
                            <img src="images/stars{{$v['satisfaction']}}.gif" alt="">
                        </div>
                        <div class="user-name-info">
                            <span class="user-name">{{$v['user_id']}}</span>
                            <span class="user-time">{{date('Y-m-d h:i:s',$v['add_time'])}}</span>
                            <span class="pro-info"></span>
                        </div>
                        <dl class="user-comment">
                            <dt class="user-comment-content"><p class="content-detail">{{$v['comment_desc']}}</p></dt>
                            <dd class="user-comment-self-input hide">
                                <div class="input-block"><input type="text" placeholder="回复楼主" class="J_commentAnswerInput"><a href="javascript:void(0);" class="btn  answer-btn J_commentAnswerBtn">回复</a></div>
                            </dd>
                        </dl>
                    </li>
                    @endforeach
                </ul>
                <div class='pagebar'>
                    <div class="pagenav">{!! $comment->appends(['goods_id'=>$goods_id])->render() !!}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--脚部-->
@endsection