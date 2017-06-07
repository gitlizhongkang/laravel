@extends('layouts.home-header')

@section('content')
    <link href="css/cart.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/shopping_flow.js"></script>
    <script type="text/javascript" src="js/utils.js"></script>
    <script type="text/javascript" src="js/xiaomi_flow.js"></script>

    <div class="xm-bg">
        <div class="page_main">
            <div class="container" style="background:#fff;">
                <div class="section section-order">
                    <div class="order-info clearfix">
                        <div class="fl">
                        </div>
                        <div class="fr">
                        </div>
                    </div>
                    <i class="iconfont icon-right">√</i>
                    <div class="order-detail">
                        <ul>
                            <li class="clearfix">
                                @if ($error == '0')
                                    <span style="font-size: 22px;color: orange">{{$msg}}</span>
                                @else
                                    <span>{{$msg}}</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>

                <p style="text-align:center; margin-bottom:36px;">您可以 <a href="index.php">返回首页</a> 或去 <a href="home-personal-index">用户中心</a></p>
            </div>
        </div>
    </div>


    <!--脚部-->
@endsection

