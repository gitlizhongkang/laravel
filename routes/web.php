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



//前台首页
Route::get('/',  'Home\IndexController@index');


//商品列表页
Route::get('/home-goods-index',  'Home\GoodsController@index');

//商品详情页
Route::get('/home-goods-goodsInfo',  'Home\GoodsController@goodsInfo');

//商品评价页面
Route::get('/home-goods-comment',  'Home\GoodsController@comment');

//获取商品的sku
Route::post('/home-goods-getSku',  'Home\GoodsController@getSku');

//添加商品到购物车
Route::post('/home-cart-add',  'Home\CartController@add');

Route::get('/home-cart-index',  'Home\CartController@index');

Route::auth();


//后台登录页面
Route::get('/admin',  'Admin\IndexController@index');
Route::post('/admin-index-login',  'Admin\IndexController@login');
//登录成功页面
Route::get('/admin-index-login_scs',  'Admin\IndexController@login_scs');
//权限管理-管理员
Route::get('/admin-index-system',  'Admin\IndexController@system');
//添加管理员
Route::get('/admin-index-add_admin',  'Admin\IndexController@add_admin');
Route::post('/admin-index-begin_add',  'Admin\IndexController@begin_add');
//统计
Route::get('/admin-count-sales',  'Admin\CountController@count_sales');
Route::post('/admin-count-count', 'Admin\CountController@count_count');
 


