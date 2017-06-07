@extends('layouts.home-header')
@section('content')
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <link href="css/category.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="http://vjs.zencdn.net/5.19.2/video-js.css">
    <script type="text/javascript" src="js/xiaomi_category.js"></script>
    <script type="text/javascript" src="js/global.js"></script>
    <script type="text/javascript" src="js/compare.js"></script>
    <style>
        .list li {
        border-bottom: 1px dashed #ccc;
        color: #222;
        height: 40px;
        line-height: 40px;
        margin-left: 0.5%;
        width: 99.5%;
        }

        .list li span {
            float: left;
            padding: 0 10px;
        }

        .list li i {
            background: rgba(0, 0, 0, 0) url("https://img.miyabaobei.com/d1/p4/2016/09/20/f1/51/f151a440a88ea9d2c822b27651b3cbfd407696682.png") no-repeat scroll 0 0;
            display: inline-block;
            float: right;
            height: 11px;
            margin-right: 10px;
            margin-top: 14px;
            width: 7px;
        }
    </style>
    <!--直播-->
    <div class="breadcrumbs">
        <div class="container" style="font-size:20px; color:deeppink; text-align: center;">
            直播
        </div>
    </div>
    <div class="container">
        <div class="filter-box">
            <video id='example-video' width=960 height=540 class="video-js vjs-default-skin" controls>
            <source src="rtmp://192.168.1.172:1935/rtmplive/lizhongkang" type="rtmp/flv">
            </video>
            <script src="video/js/video.min.js"></script>
            <script>  
            videojs.options.flash.swf = "video/js/video-js.swf";//flash路径，有一些html播放不了的视频，就需要用到flash播放。这一句话要加在在videojs.js引入之后使用  
             </script>  
           <!-- // <script src="https://npmcdn.com/videojs-contrib-hls@^3.0.0/dist/videojs-contrib-hls.min.js"></script> -->
            <script>
            var player = videojs('example-video');
            player.play();
            </script>
        </div>
    </div>
    <!--音乐-->
    <div class="breadcrumbs">
        <div class="container" style="font-size:20px; color:deeppink; text-align: center;">
           早教音乐
        </div>
    </div>
    <div class="container">
        <div class="filter-box">
            <ul class="list">
                @foreach($musicInfo as $k=>$v)
                <a href='{{ URL::to("home-music-detail?id=$v[id]") }}'title="{{ $v['title']}}">
                <li>
                    <span>{{ $v['id'] }}</span>
                    <span>
                        @if(strlen($v['title'])<120)
                            {{ $v['title'] }}
                        @else
                             {{ substr_replace($v['title'],'...',120) }}
                        @endif
                    </span>
                    <i></i>
                </li>
                </a>
                @endforeach
            </ul>
        </div>
    </div>


@endsection


<!--脚部-->

