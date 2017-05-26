<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => ['web']], function () {
    Route::get('home/user/register',  'Home\UserController@register');
    Route::post('home/user/commit',  'Home\UserController@commit');
    Route::post('home/user/loginCheck',  'Home\UserController@loginCheck');
    Route::get('home/user/login',  'Home\UserController@login');
    Route::get('home/user/forgetPassword',  'Home\UserController@forgetPassword');
    Route::get('home/user/findPassword',  'Home\UserController@findPassword');
    Route::get('home/user/bind',  'Home\UserController@bind');
    Route::get('home/user/babyBind',  'Home\UserController@babyBind');
    Route::post('home/user/getPassword',  'Home\UserController@getPassword');
    Route::post('home/user/resetPassword',  'Home\UserController@resetPassword');
    Route::any('home/user/send',  'Home\UserController@send');
    Route::get('home/user/uniqueCheck',  'Home\UserController@uniqueCheck');
    Route::get('home/user/mobileCheck',  'Home\UserController@mobileCheck');
    Route::get('home/user/codeCheck',  'Home\UserController@codeCheck');
    Route::get("home/user/code",  'Home\UserController@code');
});
Route::get('/',  'Home\IndexController@index');


