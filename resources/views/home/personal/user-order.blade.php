@extends('layouts.home-header')
<style>
    #span a{
        display:inline-block;
        width: 200px;
        text-align: center
    }
    .color{
        background-color: #c5c5c5;
        color:orangered;
    }
</style>
@section('content')
<link href="css/user.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/user.js"></script>
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
                                    <span style="font-size: 16px" id="span">
                                        <a href="?status="   bgcolor="#ffffff">全部的订单</a>|
                                        <a href="?status=1"  bgcolor="#ffffff">未完成订单 <sup>@if($userOrder['not_finish'] != 0){{$userOrder['not_finish']}} @endif</sup></a>|
                                        <a href="?status=3"  bgcolor="#ffffff">未收货订单<sup style="color: red;">@if($userOrder['not_received'] != 0){{$userOrder['not_received']}} @endif</sup></a>|
                                        <a href="?status=4"  bgcolor="#ffffff">未评价订单<sup style="color: red;">@if($userOrder['not_evaluate'] != 0){{$userOrder['not_evaluate']}} @endif</sup></a>
                                    </span>
                                    <tr align="center">
                                        <td bgcolor="#ffffff">订单号</td>
                                        <td bgcolor="#ffffff">下单时间</td>
                                        <td bgcolor="#ffffff">订单总金额</td>
                                        <td bgcolor="#ffffff">订单状态</td>
                                        <td bgcolor="#ffffff">操作</td>
                                    </tr>
                                    @foreach ($userOrder['orders']['data'] as $val)
                                    <tr class="ll">
                                        <td align="center" bgcolor="#ffffff"><a href="home-personal-orderDetail?order_id={{ $val['order_id'] }}" class="f6">{{ $val['order_sn'] }}</a></td>
                                        <td align="center" bgcolor="#ffffff">{{ date('Y-m-d H:i:s',$val['order_time']) }}</td>
                                        <td align="right" bgcolor="#ffffff">{{ $val['order_price'] }}</em>@if($val['pay_type'] == '5') 积分@else 元@endif</td>
                                        <td align="center" bgcolor="#ffffff">@if ($val['status'] == 1) 未支付 @elseif ($val['status'] == 2) 已支付 @elseif ($val['status'] == 3) 已出库 @elseif ($val['status'] == 4) 已收货 @endif</td>
                                        @if ($val['status'] == 3)
                                            <td align="center" bgcolor="#ffffff"><font class="f6"><a href="#" order_id = "{{ $val['order_id'] }}" status = "{{ $val['status'] }}"  class="click-receipt">点击收货</a></font></td>
                                        @elseif ($val['status'] == 4)
                                            <td align="center" bgcolor="#ffffff"><font class="f6"><a href="#" order_id = "{{ $val['order_id'] }}" status = "{{ $val['status'] }}"  class="click-receipt">点击评价</a></font></td>
                                        @else
                                            <td align="center" bgcolor="#ffffff"><font class="f6"><a href="#" order_id = "{{ $val['order_id'] }}" status = "{{ $val['status'] }}"  class="deleteOrder">取消订单</a></font></td>
                                        @endif
                                    </tr>
                                    @endforeach
                                    <td colspan="5" align="center" bgcolor="#ffffff">
                                        <a href="{{ substr($userOrder['orders']['prev_page_url'],strpos($userOrder['orders']['prev_page_url'],'?')) }}">上一页</a>
                                        <a href="{{ substr($userOrder['orders']['next_page_url'],strpos($userOrder['orders']['next_page_url'],'?')) }}">下一页</a>
                                    </td>
                                </table>
                                <form name="selectPageForm" action="/mishop/user.php" method="get">
                                    <div class="clearfix">
                                        <div id="pager" class="pagebar">
                                            <span class="f_l f6 " style="margin-right:10px;"> 第<b id="count">{{ceil($userOrder['orders']['current_page'])}}</b> 页  共<b id="count">{{ceil($userOrder['all']/10)}}</b>  页    总计 <b id="count">{{$userOrder['all']}}</b>  个记录</span>
                                        </div>
                                    </div>
                                </form>
                                <script type="Text/Javascript" language="JavaScript">
                                    <!--
                                    function selectPage(sel)
                                    {
                                        sel.form.submit();
                                    }
                                    //-->
                                </script>
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
<script>
    $(document).ready(function () {
        if ( '{{$_GET['status'] or ''}}'== 1) {
            $('#span').children('a').eq(1).attr('class','color');
        } else if ('{{$_GET['status'] or ''}}'== ''){
            $('#span').children('a').eq(0).attr('class','color');
        }else if ('{{$_GET['status'] or ''}}'== 3){
            $('#span').children('a').eq(2).attr('class','color');
        }else if ('{{$_GET['status'] or ''}}'== 4){
            $('#span').children('a').eq(3).attr('class','color');
        }
    })
    $(document).on('click','.deleteOrder',function () {
        var status = $(this).attr('status');
        var order_id = $(this).attr('order_id');
        var obj = $(this);
        if(confirm('您确认要取消该订单吗？取消后此订单将视为无效订单')){
            if (status > 1) {
                alert('只有未支付的订单可以取消，请和店主联系。');
                return false;
            }
            $.ajax({
                type:'post',
                url:'home-personal-deleteOrder',
                data:{_token:"{{csrf_token()}}",order_id:order_id},
                dataType:'json',
                success:function (data) {
                    if(data['error'] == 0) {
                        alert(data['msg']);
                        obj.parents('tr').remove();
                    } else {
                        alert(data['msg']);
                    }
                }
            })
        }
    })

    $(document).on('click','.click-receipt',function () {
        var status = $(this).attr('status');
        var order_id = $(this).attr('order_id');
        var obj = $(this);
        if(confirm('您确认要改变收货状态吗？改变后将无法修改')){
            $.ajax({
                type:'post',
                url:'home-personal-updateOrderStatus',
                data:{_token:"{{csrf_token()}}",order_id:order_id},
                dataType:'json',
                success:function (data) {
                    if(data['error'] == 0) {
                        alert(data['msg']);
                        location.href = '';
                    } else {
                        alert(data['msg']);
                    }
                }
            })
        }
    })
</script>
@endsection