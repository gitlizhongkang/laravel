@extends('layouts.header')

@section('title')
  baby -- register
@stop

@section('content')
<div class="register_wrap">
    <div class="bugfix_ie6 dis_none">
        <div class="n-logo-area clearfix">
            <a href="./" class="fl-l"></a>
        </div>
    </div>
    <div id="main">
        <div class="n-frame device-frame reg_frame">
            <div class="title-item dis_bot35 t_c">
                <h4 class="title-big">register </h4>
            </div>
            <div class="regbox" id="register_box">
                <form action="{{ URL::to('home/user/commit')}}" method="POST"  name="formUser">
                    {{ csrf_field() }}
                    <div class="phone_step1">
                        <input type="hidden" id="sendtype">
                        <div class="inputbg">
                            <label class="labelbox">
                                <input type="text" name="username" id="username" state="0"  placeholder="用户名">
                            </label>
                            <span class="t_text">用户名</span>
                            <span class="error_icon"></span>
                        </div>
                        <div class="err_tip" id="username_notice"> <em></em> </div>

                        <div class="inputbg">
                            <label class="labelbox">
                                <input name="tel" type="text" id="tel" state="0"  placeholder="手机号">
                            </label>
                            <span class="t_text">手机号</span>
                            <span class="error_icon"></span>
                        </div>
                        <div class="err_tip" id="tel_notice"><em></em> </div>

                        <div class="inputbg">
                            <label class="labelbox">
                                <input type="password" name="password" id="password1" state="0"   placeholder="密码">
                            </label>
                            <span class="t_text">密码</span>
                            <span class="error_icon"></span>
                        </div>
                        <div class="err_tip" id="password_notice"> <em></em> </div>

                        <div class="inputbg">
                            <label class="labelbox">
                                <input name="confirm_password"  type="password" id="conform_password" state="0"  placeholder="确认密码">
                            </label>
                            <span class="t_text">确认密码</span>
                            <span class="error_icon"></span>
                        </div>
                        <div class="err_tip" id="conform_password_notice"> <em></em> </div>

                        <div class="inputbg inputcode dis_box clearfix">
                            <label class="labelbox label-code">
                                <input type="text" class="code" id="code"  name="captcha" maxlength="6"  state="0"placeholder="验证码">
                            </label>
                            <span class="t_text">验证码</span>
                            <span class="error_icon"></span>
                            <img src="{{ URL::to('home/user/code') }}" id="codeImg" alt="captcha" class="icode_image code-image chkcode_img" onClick="this.src='{{ URL::to("home/user/code?r=") }}'+Math.random()" />
                        </div>
                        <div class="err_tip" id="code_notice"> <em></em> </div>

                        <div class="inputbg inputcode dis_box clearfix">
                            <label class="labelbox label-code">
                                <input type="text" class="code" id="mobileCode"  name="mobileCode" maxlength="6" placeholder="手机验证码">
                            </label>
                            <span class="t_text">手机验证码</span>
                            <span class="error_icon"></span>
                            <button class="getCode">获取验证码</button>
                        </div>
                        <div class="err_tip" id="mobilecode_notice"> <em></em> </div>


                        <div class="law">
                            <label>
                                <input name="agreement" type="checkbox" value="1" checked="checked"  tabindex="5" class="remember-me"/>
                                我已看过并接受《<a href="article.php?cat_id=-1" style="color:blue" target="_blank">用户协议</a>》</label>
                        </div>
                        <div class="err_tip"> <em></em> </div>
                        <div class="fixed_bot mar_phone_dis1">
                            <input name="act" type="hidden" value="act_register" >
                            <input type="hidden" name="back_act" value="" />
                            <input name="Submit" type="submit" value="please enter F5" class="btn332 btn_reg_1 submit-step">
                        </div>
                        <div class="trig">已有账号? <a href="{{ URL::to('home/user/login') }}" class="trigger-box">点击登录</a> </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
      <div class="n-footer">
        <p class="nf-intro"><span>©<a href='#'>mi.com</a> 京ICP证110507号 京ICP备10046444号 京公网安备1101080212535号 <a href='#'>京网文[2014]0059-0009号</a></span></p>
    </div>
</div>
    @stop

