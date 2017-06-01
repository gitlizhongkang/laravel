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
            <a href=".">首页</a> <code>&gt;</code> 用户中心
        </div>
    </div>

    <div class="xm-bg">
        <div id="wrapper" class="container">
            <div class="my_nala_main">
                {{--侧栏--}}
                @include('home/personal/left')

                <div class="my_nala_centre ilizi_centre">
                    <div class="ilizi cle">
                        <div class="box">
                            <div class="box_1">
                                <div class="userCenterBox boxCenterList clearfix" style="_height:1%;">
                                    <h1>我的订单</h1>
                                    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                                        <tr align="center">
                                            <td bgcolor="#ccc">订单号</td>
                                            <td bgcolor="#ccc">操作</td>
                                        </tr>
                                        @foreach ($userOrder as $val)
                                            <tr align="center">
                                                <td bgcolor="#ffffff">{{ $val['order_sn'] }}</td>
                                                <td bgcolor="#ffffff"><a href="home-personal-getTracking?logistics_number={{ $val['logistics_number'] }}">查看物流</a></td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection