@extends('layouts.header')

@section('title')
    baby -- forget
@stop

@section('content')

<div class="register_wrap">
    <div id="main" class="">

        <h3 class="n-frame device-frame reg_frame">
            <div class="title-item dis_bot35 t_c">
                <h4 class="title-big">forget password</h4>
            </div>
            <div class="regbox">
                <form  method="post" id="getPassword" name="getPassword" onsubmit="return submitPwdInfo();">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <div class="inputbg">
                        <label class="labelbox">
                            <input name="user_name" type="text" size="30" placeholder="用户名"/>
                        </label>
                        <span class="t_text">用户名</span>
                        <span class="error_icon"></span>
                    </div>
                    <div class="inputbg">
                        <label class="labelbox">
                            <input name="email" type="text" size="30" class="inputBg"   placeholder="电子邮件地址"/>
                        </label>
                        <span class="t_text">电子邮件地址</span>
                        <span class="error_icon"></span>
                    </div>
                    <div class="fixed_bot mar_phone_dis1">
                        <input type="submit" name="submit" value="please enter F5" class="btn332 btn_reg_1 submit-step" style="border:none;" />
                        <input name="button" type="button" onclick="history.back()" value="返回上一页" style="border:none;" class="button" />
                    </div>
                </form>
            </div>
        </div>
        <div class="n-footer">
            <div class="nl-f-nav">
                <p class="nf-intro"><span>©<a href='#'>mi.com</a> 京ICP证110507号 京ICP备10046444号 京公网安备1101080212535号 <a href='#'>京网文[2014]0059-0009号</a></span></p>
            </div>
        </div>
    </div>
</div>
@stop

