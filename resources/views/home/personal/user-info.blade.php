
@include('header');
<link href="css/user.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/xiaomi_common.js"></script>
<script type="text/javascript" src="js/md5.js"></script>
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
                                                <input type="radio" name="sex" value="2" class="sex"  @if($userInfo['sex']==2) checked  @endif /> 女
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

@include('footer')
<script type="text/javascript" src="js/parsonal/userInfo.js"></script>

