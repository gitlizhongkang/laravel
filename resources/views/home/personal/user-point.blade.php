
@extends('layouts.home-header')

@section('content')
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="icon" href="animated_favicon.gif" type="image/gif" />
    <link href="css/user.css" rel="stylesheet" type="text/css" />
    <link href="css/user-point.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/common.js"></script>
    <script type="text/javascript" src="js/user.js"></script>
    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="js/transport_jquery.js"></script>
    <script type="text/javascript" src="js/jquery.SuperSlide.js"></script>
    <script type="text/javascript" src="js/xiaomi_common.js"></script>
    <body class="user_center">
    <div class="breadcrumbs">
        <div class="container">
            <a href=".">首页</a>
            <code>&gt;</code> 用户中心
        </div>
    </div>
    <div class="xm-bg">
        <div id="wrapper" class="container">
            <div class="my_nala_main">
                @include('/home/personal/left')
                <div class="my_nala_centre ilizi_centre">
                    <div class="ilizi cle">
                        <div class="box">
                            <div class="box_1">
                                <div class="userCenterBox boxCenterList clearfix" style="_height:1%;">
                                    <h1>积分明细</h1>
                                    <div class="summary clearfix" style="height: 80px">
                                    <div class="item valid">
                                    <span class="desc">可用的积分</span>
                                    <span class="point">{{ $point }}</span>
                                    </div>
                                    <div class="item expired-soon" style="padding-right:50px ">
                                    <span class="desc" style="color: rgb(153, 153, 153);">去年过期的积分</span>
                                    <span class="point" style="color: rgb(153, 153, 153);">0</span>
                                    <span class="date" style="color: rgb(153, 153, 153);">(已于2016.12.31过期)</span>
                                    </div>
                                    <div class="item exchange">
                                    <a href="home-pointMall-index" target="_blank" style="margin-left: 50px;margin-right:14px " >兑换超值商品与优惠劵</a>
                                    </div>
                                    </div>
                                    <table style="margin-top: 20px;margin-left: 80px">
                                        <tr bgcolor="#a9a9a9">
                                        <th style="width: 200px">简述</th>
                                        <th style="width: 200px">积分</th>
                                        <th style="width: 200px">添加时间</th>
                                        </tr>
                                        @foreach ($points as $val)
                                            <tr align="center">
                                                <td>{{ $val['content'] }}</td>
                                                <td>@if ($val['status'] == 1) + @else - @endif {{ $val['point'] }}</td>
                                                <td>{{ date('Y-m-d H:i:s',$val['add_time']) }}</td>
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