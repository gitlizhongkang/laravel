@extends('layouts.header')

@section('title')
    baby -- reset
@stop

@section('content')

    <div class="register_wrap">
        <div id="main" class="">
            <div class="n-frame device-frame reg_frame">

                <div class="title-item dis_bot35 t_c">
                    <h4 class="title-big">reset password</h4>
                </div>
                <div class="regbox">
                    <form id="resetPassword" name="resetPassword" onsubmit="return submitPwd();">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="user_id" type="hidden" value="{{ $id }}">
                        <input name="key" tppe="hidden" value="{{ $key }}">
                        <div class="inputbg">
                            <label class="labelbox">
                                <input id="new_password" name="new_password" type="password" size="30" placeholder="新密码"/>
                            </label>
                            <span class="t_text">密码</span>
                            <span class="error_icon"></span>
                        </div>
                        <div class="inputbg">
                            <label class="labelbox">
                                <input name="confirm_password" id="confirm_password" type="password" size="30" class="inputBg"   placeholder="请确认密码"/>
                            </label>
                            <span class="t_text">确认密码</span>
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