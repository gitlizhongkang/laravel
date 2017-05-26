@extends('layouts.header')

@section('title')
    baby -- bind
@stop

@section('content')
    <div class="register_wrap">
        <div class="bugfix_ie6 dis_none">
            <div class="n-logo-area clearfix">
                <a href="./" class="fl-l"></a>
            </div>
        </div>
        <div id="main">
            <div style="margin:0 auto; width:1000px;">
                <div class="r-tab r-check" id="has_login" >
                    <span>已有账号，请绑定</span>
                </div>
                <div  class="r-tab" id="no_login">
                    <span>没有账号，请完善资料</span>
                </div>
            </div>

            <div class="n-frame device-frame reg_frame " id="register-box" style="display:none;">
                <div class="title-item dis_bot35 t_c">
                    <h4 class="title-big"> Hi,<span style="color:red;">{{$uname}}</span> 欢迎来到Baby, 完成绑定后可以微博账号一键登录哦</h4>
                </div>
                <div class="regbox" >
                    <form action="{{ URL::to('home/user/commit')}}" method="POST"  name="formUser">
                        {{ csrf_field() }}
                        <input type="hidden" name="type" value="bind-register">
                        <input type="hidden" name="weiboName" value="{{$uname}}">
                        <input type="hidden" name="weiboId" value="{{$uid}}">
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
                        </div>
                    </form>
                </div>
            </div>


            <div class="n-frame device-frame reg_frame " id="login-box">
                <div class="title-item dis_bot35 t_c">
                    <h4 class="title-big"> Hi,<span style="color:red;">{{$uname}}</span> 欢迎来到Baby, 完成绑定后可以微博账号一键登录哦 </h4>
                </div>
                <div class="regbox" >
                    <div class="ng-form-area show-place">
                        <form name="formLogin" id="formLogin" action="{{ URL::to("home/user/loginCheck") }}"  method="post" onSubmit="return userLogin()">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <input type="hidden" name="type" value="bind-login">
                            <input type="hidden" name="weiboName" value="{{$uname}}">
                            <input type="hidden" name="weiboId" value="{{$uid}}">
                            <div class="shake-area">
                                <div class="enter-area">
                                    <input name="username" type="text"   class="enter-item first-enter-item" placeholder="用户名/手机号/邮箱号"/>
                                    <i class="placeholder">用户名</i>
                                </div>
                                <div class="enter-area">
                                    <input name="password" type="password" class="enter-item last-enter-item" placeholder="密码"/>
                                    <i class="placeholder">密码</i>
                                </div>
                            </div>

                            <input type="submit" name="submit" disabled="disabled" class="button orange" value="please enter F5">
                            <div class="ng-foot clearfix">
                                <div class="ng-cookie-area">
                                </div>
                                <div class="ng-link-area">
                                    <span><a href="{{ URL::to("home/user/forgetPassword") }}">忘记密码?</a></span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


        </div>
        <div class="n-footer">
            <p class="nf-intro"><span>©<a href='#'>mi.com</a> 京ICP证110507号 京ICP备10046444号 京公网安备1101080212535号 <a href='#'>京网文[2014]0059-0009号</a></span></p>
        </div>
@stop

