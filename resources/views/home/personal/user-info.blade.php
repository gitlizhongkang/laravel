<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <title>商城</title>
    <link rel="shortcut icon" href="favicon.ico" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/user.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/common.js"></script>
    <script type="text/javascript" src="js/user.js"></script>
    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.json.js"></script>
    <script type="text/javascript" src="js/transport_jquery.js"></script>
    <script type="text/javascript" src="js/utils.js"></script>
    <script type="text/javascript" src="js/jquery.SuperSlide.js"></script>
    <script type="text/javascript" src="js/xiaomi_common.js"></script>
    <script type="text/javascript" src="js/md5.js"></script>
    <script type="text/javascript">
        function checkSearchForm()
        {
            if(document.getElementById('keyword').value)
            {
                return true;
            }
            else
            {
                alert("请输入搜索关键词！");
                return false;
            }
        }
    </script>
</head>
<body class="user_center">

{{--@include('header');--}}

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
                                <h1>个人资料</h1>
                                <form name="formEdit" action="home-personal-updateUserInfo" method="post" onsubmit="return false">
                                    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                                        <tbody username="{{ $userInfo['username'] }}" tel="{{ $userInfo['tel'] }}" sex="{{ $userInfo['sex'] }}" age="{{ $userInfo['age'] }}" email="{{ $userInfo['email'] }}">
                                        <tr>
                                            <td width="28%" align="right" bgcolor="#FFFFFF">用户名： </td>
                                            <td width="72%" align="left" bgcolor="#FFFFFF"><input name="username" id="username" type="text" value="{{ $userInfo['username'] }}" size="25" class="inputBg" /><span style="color:#FF0000"> *</span></td>
                                        </tr>
                                        <tr>
                                            <td width="28%" align="right" bgcolor="#FFFFFF">Tel： </td>
                                            <td width="72%" align="left" bgcolor="#FFFFFF"><input name="tel" id="tel" type="text" value="{{ $userInfo['tel'] or '' }}" size="25" class="inputBg" /><span style="color:#FF0000"> *</span></td>
                                        </tr>
                                        <tr>
                                            <td width="28%" align="right" id="sex" bgcolor="#FFFFFF">性　别： </td>
                                            <td width="72%" align="left" bgcolor="#FFFFFF">
                                                <input type="radio" name="sex" value="1" calss="sex"  @if($userInfo['sex']==1) checked  @endif /> 男&nbsp;&nbsp;
                                                <input type="radio" name="sex" value="0" class="sex"  @if($userInfo['sex']==0) checked  @endif /> 女
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="28%" align="right" bgcolor="#FFFFFF">年  龄： </td>
                                            <td width="72%" align="left" bgcolor="#FFFFFF"><input name="age" id="age" type="text" value="{{ $userInfo['age'] }}" size="25" class="inputBg" /></td>
                                        </tr>
                                        <tr>
                                            <td width="28%" align="right" bgcolor="#FFFFFF">电子邮件地址： </td>
                                            <td width="72%" align="left" bgcolor="#FFFFFF"><input name="email" id="email" type="text" value="{{ $userInfo['email'] }}" placeholder="绑定邮箱" size="25" class="inputBg" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" align="center" bgcolor="#FFFFFF">
                                                <input type="submit" id="userInfoSubmit" value="确认修改" class="btn btn-primary" style="border:none;" />
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </form>
                                <form name="formPassword" action="user.php" method="post" onsubmit="return false">
                                    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                                        <tbody>
                                        <tr>
                                            <td width="28%" align="right" bgcolor="#FFFFFF">原密码：</td>
                                            <td width="76%" align="left" bgcolor="#FFFFFF"><input name="old_password" type="password" size="25" class="inputBg old_password" /></td>
                                        </tr>
                                        <tr>
                                            <td width="28%" align="right" bgcolor="#FFFFFF">新密码：</td>
                                            <td align="left" bgcolor="#FFFFFF"><input name="new_password" type="password" size="25" class="inputBg new_password" /></td>
                                        </tr>
                                        <tr>
                                            <td width="28%" align="right" bgcolor="#FFFFFF">确认密码：</td>
                                            <td align="left" bgcolor="#FFFFFF"><input name="comfirm_password" type="password" size="25" class="inputBg comfirm_password" /><span class="ts_password"></span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="submit" type="submit" class="btn btn-primary" id="passwordSubmit" style="border:none;" value="确认修改" /></td>
                                        </tr>
                                        </tbody>
                                    </table>
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
</body>

{{--@include('footer')--}}

<script>
    //修改用户信息
    $(document).on('click','#userInfoSubmit',function () {
        var username = $('#username').val();
        var tel = $('#tel').val();
        var age = $('#age').val();
        var email = $('#email').val();
        for (var i = 0;i < $("input[name='sex']").length;i ++){
            if ($("input[name='sex']").eq(i).prop('checked') == true){
                var sex = $("input[name='sex']").eq(i).val();
            }
        }
        var oldUsername = $(this).parents('tbody').attr('username');
        var oldTel = $(this).parents('tbody').attr('tel');
        var oldAge = $(this).parents('tbody').attr('age');
        var oldEmail = $(this).parents('tbody').attr('email');
        var oldSex = $(this).parents('tbody').attr('sex');
        if (username == oldUsername && tel == oldTel && age == oldAge && email == oldEmail && sex == oldSex) {
            alert('修改成功');
            return false;
        }
        $.ajax({
            type:'post',
            url:'home-personal-updateUserInfo',
            data:{_token:"{{csrf_token()}}",username:username,tel:tel,sex:sex,age:age,email:email},
            dataType:'json',
            success:function (data) {
                alert(data['msg']);
            }
        })
    })

    //确认密码
    $(document).on('blur','.comfirm_password',function () {
        var new_password = $('.new_password').val();
        var comfirm_password = $(this).val();
        if (comfirm_password == '') {
            $('.ts_password').html('<font color="red">确认密码不能为空<font>');

            return false;
        } else if (new_password != comfirm_password) {
            $('.ts_password').html('<font color="red">两次密码输入不相同<font>');

            return false;
        } else {
            $('.ts_password').html('<font color="#32cd32">√ <font>');
        }
    })

    //修改密码
    $(document).on('click','#passwordSubmit',function () {
        $('.comfirm_password').trigger('blur');
        var new_password = hex_md5($('.new_password').val());
        var old_password = hex_md5($('.old_password').val());
        var comfirm_password = hex_md5($('.comfirm_password').val());
        if (new_password != comfirm_password) {
            return false;
        }
        $.ajax({
            type:'post',
            url:'updatePassword',
            data:{new_password:new_password,old_password:old_password},
            dataType:'json',
            success:function (data) {
                alert(data['msg'])
            }
        })
    })
</script>