<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="favicon.ico"/>
    <link href="{{ URL::asset('css/login.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .r-tab{
            width: 50%; text-align: center;border-bottom: solid 2px #CCCCCC;font-size: 18px;float: left;height: 32px;cursor: pointer;
        }
        .r-check{
            border-bottom: solid 2px red;
        }

    </style>
    <script>

        var codeCheck="{{ URL::to('home/user/codeCheck') }}";
        var uniqueCheck="{{ URL::to('home/user/uniqueCheck') }}";
        var mobileCheck="{{ URL::to('home/user/mobileCheck') }}";
        var getPassword="{{ URL::to('home/user/getPassword') }}";
        var commitUrl="{{ URL::to('home/user/commit') }}";
        var loginCheck="{{ URL::to('home/user/loginCheck') }}";
        var resetPassword="{{ URL::to('home/user/resetPassword') }}";
        var loginUrl="{{ URL::to('home/user/login') }}";
        var sendUrl="{{ URL::to('home/user/send') }}";
        var indexUrl="{{ URL::to('/') }}";
        var tel_registered= "该手机号已被注册";
        var msg_code="验证码不正确";
        var msg_code_blank="验证码不能为空";
        var user_name_empty = "请输入您的用户名！";
        var email_address_empty = "请输入您的电子邮件地址！";
        var email_address_error = "您输入的电子邮件地址格式不正确！";
        var new_password_empty = "请输入您的新密码！";
        var confirm_password_empty = "请输入您的确认密码！";
        var both_password_error = "您两次输入的密码不一致！";
        var caps_info = "大写锁已开启";
        var process_request = "正在处理您的请求...";
        var username_empty = "用户名不能为空。";
        var username_shorter = "用户名长度不能少于 3 个字符。";
        var username_invalid = "用户名只能是由字母数字以及下划线组成。";
        var password_empty = "登录密码不能为空。";
        var password_shorter = "登录密码不能少于 6 个字符。";
        var confirm_password_invalid = "两次输入密码不一致";
        var email_empty = "Email 为空";
        var email_invalid = "Email 不是合法的地址";
        var agreement = "您没有接受协议";
        var tel_empty = "手机号为空";
        var tel_msg= "手机号码不是一个有效号码";
        var msg_un_blank = "用户名不能为空";
        var msg_un_length = "用户名最长不得超过7个汉字";
        var msg_un_format = "用户名含有非法字符";
        var msg_un_registered = "用户名已经存在,请重新输入";
        var msg_can_rg = "可以注册";
        var msg_email_blank = "邮件地址不能为空";
        var msg_email_registered = "邮箱已存在,请重新输入";
        var msg_email_format = "邮件地址不合法";
        var msg_blank = "不能为空";
        var passwd_balnk = "- 密码中不能包含空格";
        var username_exist = "用户名 %s 已经存在";
    </script>
    <script type="text/javascript" src="{{ URL::asset('js/jquery-1.9.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/common.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/user.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jquery.md5.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jquery.json.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/transport_jquery.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/utils.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jquery.SuperSlide.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/xiaomi_common.js') }}"></script>
    <script>
        $(function(){
            //判断是否禁止JS
            $("input[type='submit']").removeAttr("disabled").val("come on baby");
            //加载清空文本框
            $("input:text,input:password").val("");
            //提示文字隐藏显示效果
            //登录界面
            $(".enter-area .enter-item").focus(function(){
                if($(this).val().length==0){
                    $(this).siblings(".placeholder").addClass("hide");
                }
            }).blur(function(){
                if($(this).val().length==0){
                    $(this).siblings(".placeholder").removeClass("hide");
                }
            }).keyup(function(){
                if($(this).val().length>0){
                    $(this).siblings(".placeholder").addClass("hide");
                }else{
                    $(this).siblings(".placeholder").removeClass("hide");
                }
            });
            //注册界面
            $("input:text,input:password").focus(function(){
                if($(this).val().length>0){
                    $(this).parent().siblings(".t_text").addClass("hide");
                }
            }).blur(function(){
                if($(this).val().length==0){
                    $(this).parent().siblings(".t_text").removeClass("hide");
                }
            }).keyup(function(){
                if($(this).val().length>0){
                    $(this).parent().siblings(".t_text").addClass("hide");
                }else{
                    $(this).parent().siblings(".t_text").removeClass("hide");
                }
            });

            //其它登录方式
            $("#other_method").click(function(){
                if($(".third-area").hasClass("hide")){
                    $(".third-area").removeClass("hide");
                }else{
                    $(".third-area").addClass("hide");
                }
            })
        })
    </script>

</head>
<body>
    @yield('content')
</body>
</html>