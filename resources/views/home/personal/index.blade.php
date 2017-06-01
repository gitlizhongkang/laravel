
@extends('layouts.home-header')

@section('content')
 <link href="css/user.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="js/common.js"></script>
 <script type="text/javascript" src="js/user.js"></script>
 <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
 <script type="text/javascript" src="js/jquery.json.js"></script>
 <script type="text/javascript" src="js/transport_jquery.js"></script>
 <script type="text/javascript" src="js/utils.js"></script>
 <script type="text/javascript" src="js/jquery.SuperSlide.js"></script>
 <script type="text/javascript" src="js/xiaomi_common.js"></script>
 <body class="user_center">
  <!--通栏-->
  <div class="breadcrumbs"> 
   <div class="container"> 
    <a href=".">首页</a> 
    <code>&gt;</code> 用户中心 
   </div> 
  </div> 
  <div class="xm-bg"> 
   <div id="wrapper" class="container">
    <div class="my_nala_main">
     @include('home/personal/left')
     <div class="my_nala_centre ilizi_centre"> 
      <div class="ilizi cle"> 
       <div class="box"> 
        <div class="box_1"> 
         <div class="userCenterBox boxCenterList clearfix" style="_height:1%; font-size:14px;"> 
          <div class="portal-main clearfix"> 
           <div class="user-card"> 
            <h2 class="username">{{ $userInfo['username'] }}</h2>
            <p class="tip">欢迎您回到 Baby 商城 ~</p>
            <a class="link" href="home-personal-userInfo">修改个人资料&gt;</a>
            <img class="avatar" src="images/photo.jpg" />
           </div> 
           <div class="user-actions"> 
            <ul class="action-list"> 
             <li> 您加入Baby大家庭时间：{{ date('Y-m-d H:i:s',$userInfo['reg_time']) }}</li>
             <li class="rank">您的等级是    @if (time()-$userInfo['reg_time'] < 60*60*24*7 )新注册成员 @elseif(time()-$userInfo['reg_time'] < 60*60*24*365 ) 高级成员 @else 特级成员 @endif<span></span></li>
             <li class="validat">您还没有通过邮件认证 <a href="javascript:sendHashMail()" style="color:#f70;">点此发送认证邮件</a></li>
            </ul>
           </div> 
          </div> 
          <div class="portal-sub"> 
           <ul class="info-list clearfix"> 
            <li> <h3>余额：<span class="num">0.00<em>元</em>元</span></h3> <a href="#">查看您的账户余额<i class="iconfont"></i></a> <img src="images/portal-icon-1.png" /> </li>
            <li> <h3>地址：<span class="num">共计 {{ $countAddress['data'] }} 个</span></h3> <a href="home-personal-userAddress">查看您的地址信息<i class="iconfont"></i></a> <img src="images/portal-icon-2.png" /> </li>
            <li> <h3>积分：<span class="num">{{ $userInfo['user_point'] }}积分</span></h3> <img src="images/portal-icon-3.png" /> </li>
            <li> <h3> 用户提醒： <span class="num"> 您最近30天内提交了{{ $countOrder['data'] }}个订单<br /> </span> </h3> <img src="images/portal-icon-4.png" /> </li>
           </ul> 
          </div> 
         </div> 
        </div> 
       </div> 
      </div> 
     </div> 
    </div> 
   </div> 
  </div> 
  <div class="breadcrumbs"></div> 
  <script type="text/javascript">
    var msg_title_empty = "留言标题为空";
    var msg_content_empty = "留言内容为空";
    var msg_title_limit = "留言标题不能超过200个字";
</script>
 @endsection