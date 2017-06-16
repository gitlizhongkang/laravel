@extends('layouts.home-header')

@section('content')
    <link href="css/user.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/user.js"></script>
<body class="user_center">

<!--通栏-->
<div class="breadcrumbs">
    <div class="container">
        <a href=".">首页</a> <code>&gt;</code> 用户中心    </div>
</div>

<div class="xm-bg">
    <div id="wrapper" class="container"><div class="my_nala_main">
                {{--侧栏--}}
                @include('home/personal/left')
            <div class="my_nala_centre ilizi_centre">
                <div class="ilizi cle">
                    <div class="box">
                        <div class="box_1">
                            <div class="userCenterBox boxCenterList clearfix" style="_height:1%;">
                                <script type="text/javascript">
                                    var bonus_sn_empty = "请输入您要添加的红包号码！";
                                    var bonus_sn_error = "您输入的红包号码格式不正确！";
                                    var email_empty = "请输入您的电子邮件地址！";
                                    var email_error = "您输入的电子邮件地址格式不正确！";
                                    var old_password_empty = "请输入您的原密码！";
                                    var new_password_empty = "请输入您的新密码！";
                                    var confirm_password_empty = "请输入您的确认密码！";
                                    var both_password_error = "您现两次输入的密码不一致！";
                                    var msg_blank = "不能为空";
                                    var no_select_question = "- 您没有完成密码提示问题的操作";
                                </script>
                                <h1>我的红包</h1>
                                <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                                    <tr>
                                        <th align="center" bgcolor="#FFFFFF">红包序号</th>
                                        <th align="center" bgcolor="#FFFFFF">红包名称</th>
                                        <th align="center" bgcolor="#FFFFFF">红包金额</th>
                                        <th align="center" bgcolor="#FFFFFF">最小订单金额</th>
                                        <th align="center" bgcolor="#FFFFFF">截至使用日期</th>
                                        <th align="center" bgcolor="#FFFFFF">红包状态</th>
                                    </tr>
                                    @if (empty($userPack))
                                        <tr>
                                            <td colspan="6" bgcolor="#FFFFFF">您现在还没有红包</td>
                                        </tr>
                                    @else
                                        @foreach ($userPack['data'] as $val)
                                            <tr bgcolor="#FFFFFF" align="center" class="ll">
                                                <td bgcolor="#FFFFFF">{{ $val['pack_sn'] }}</td>
                                                <td bgcolor="#FFFFFF">{{ $val['pack_name'] }}</td>
                                                <td bgcolor="#FFFFFF">{{ $val['pack_price'] }}</td>
                                                <td bgcolor="#FFFFFF">{{ $val['low_use_price'] or '无门槛' }}</td>
                                                <td bgcolor="#FFFFFF">{{ date('Y-m-d H:i:s',$val['pack_use_time']) }}</td>
                                                <td bgcolor="#FFFFFF">@if (time() > $val['pack_use_time']) 已过期 @elseif ($val['status'] == 0) 未使用 @else 已使用 @endif</td>
                                            </tr>
                                        @endforeach
                                    <tr>
                                        <td colspan="6" align="center" bgcolor="#ffffff">
                                            <a href="{{ substr($userPack['prev_page_url'],strpos($userPack['prev_page_url'],'?')) }}">上一页</a>
                                            <a href="{{ substr($userPack['next_page_url'],strpos($userPack['next_page_url'],'?')) }}">下一页</a>
                                        </td>
                                    </tr>
                                    @endif
                                </table>

                                <form name="selectPageForm" action="/mishop/user.php" method="get">
                                    <div class="clearfix">
                                        <div id="pager" class="pagebar">
                                            <span class="f_l f6" style="margin-right:10px;">总计 <b id="count">0</b>  个记录</span>
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
                                <h1>添加红包</h1>
                                <form name="addBouns" action="" method="post" onSubmit="return false">
                                    <div style="padding: 15px;">
                                        红包序列号
                                        <input name="bonus_sn" type="text" size="30" class="inputBg" />
                                        <input type="hidden" name="act" value="act_add_bonus" class="inputBg" />
                                        <input type="submit" class="btn btn-primary addPack" value="添加红包"  style=" height:26px; line-height:25px; *line-height:22px; width:120px; margin-left:10px; vertical-align:-2px; *vertical-align:-5px;"/>
                                    </div>
                                </form>
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
        var length = $('.ll').length;
        $('#count').html(length);
    })
    $(".addPack").click(function () {
        var bonus_sn = $('.inputBg').val();
        $.ajax({
            type:'post',
            url:'home-personal-addPack',
            data:{_token:"{{csrf_token()}}",bonus_sn:bonus_sn},
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
    })
</script>
<!--脚部-->
</body>
@endsection
