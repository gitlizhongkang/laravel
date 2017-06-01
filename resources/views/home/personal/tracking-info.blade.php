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
                                            <td bgcolor="#ccc">订单号：{{ $logistics_number }}</td>
                                            <td bgcolor="#ccc">服务商：{{ $logistics_type }}</td>
                                            <td bgcolor="#ccc">状态：@if ($result['issign'] == 1) <font color="#32cd32" size="4px">已签收</font> @else <font color="red">未签收</font> @endif</td>
                                        </tr>
                                    </table>
                                    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                                        @foreach ($result['list'] as $val)
                                            <tr align="center">
                                                <td bgcolor="#ffffff">{{ $val['status'] }}</td>
                                                <td bgcolor="#ffffff">{{ $val['time'] }}</td>
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