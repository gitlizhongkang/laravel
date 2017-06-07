@extends('layouts.home-header')

@section('content')
    <link href="css/category.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/xiaomi_category.js"></script>
    <script type="text/javascript" src="js/global.js"></script>
    <script type="text/javascript" src="js/compare.js"></script>
    <style>

        .music_tit {
            border-bottom: 2px solid #ccc;
            color: #333;
            font-size: 16px;
            font-weight: normal;
            line-height: 34px;
            margin-bottom: 10px;
        }
        .music_desc {
            line-height: 2;
        }

        .w1004 {
            min-height: 400px;
            padding: 30px 0;
        }
        .w1004 {
            margin: 0 auto;
            width: 1000px;
        }

        .music_con {
            border-radius: 10px;
            height: 30px;
            margin: 100px auto 30px;
            padding: 3px 5px;
            width: 380px;
        }
    </style>
    <!--通栏-->
    <div class="breadcrumbs">
        <div class="container">
            <a href="{{URL::to('/')}}">首页</a>
            <code>&gt;</code><a href='{{ URL::to("home-music-index") }}'>早教</a>
            <code>></code><a href='{{ URL::to("home-music-detail?id=$musicInfo[id]") }}'>音乐欣赏</a>
        </div>
    </div>
    <!--音乐中心-->
    <div class="container">
            <div class="w1004">
                <h2 class="music_tit">{{ $musicInfo['title'] }}</h2>
                <div class="music_desc">{{ $musicInfo['content'] }}</div>
                <div class="music_con">
                    <audio controls="controls">
                        <source src="{{ $musicInfo['path'] }}" type="audio/mpeg"></source>
                    </audio>
                </div>
            </div>
    </div>
@endsection


<!--脚部-->

