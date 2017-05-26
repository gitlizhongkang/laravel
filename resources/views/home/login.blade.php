@extends('layouts.header')

@section('title')
  baby -- login
@stop

@section('content')
<div id="main" class="layout">
    <div class="nl-content">
        <h1 class="nl-login-title">login</h1>
        <p class="nl-login-intro"></p>
        <div id="login-box" class="nl-frame-container">
            <div class="ng-form-area show-place">
                <form name="formLogin" id="formLogin" action="{{ URL::to("home/user/loginCheck") }}"  method="post" onSubmit="return userLogin()">
               <input name="_token" type="hidden" value="{{ csrf_token() }}">
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
                            <label><input type="checkbox" value="1" name="remember" id="remember" class="remember-me">请保存我这次的登录信息。</label>
                        </div>
                        <div class="ng-link-area">
                            <span><a href="https://api.weibo.com/oauth2/authorize?client_id=699688608&redirect_uri={{ urlencode("http://www.sale.com/public/index.php/home/user/bind") }}" >微博</a><span> | </span></span>
                            <span><a href="{{ URL::to("home/user/forgetPassword") }}">忘记密码?</a></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
       <div class="nl-footer">
        <div class="nl-f-nav">
        <p class="nl-f-copyright">©<a href='#'>mi.com</a> 京ICP证110507号 京ICP备10046444号 京公网安备1101080212535号 <a href='#'>京网文[2014]0059-0009号</a></p>
        </div>
    </div>
</div>
@stop
