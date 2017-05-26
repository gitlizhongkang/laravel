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
    //
});
Route::get('/',  'Home\IndexController@index');
//个人中心-首页
Route::get('home-personal-index',  'Home\PersonalController@index');
//个人中心-订单
Route::get('home-personal-userOrder',  'Home\PersonalController@userOrder');
//个人中心-获取订单
Route::post('home-personal-getUserOrder',  'Home\PersonalController@getUserOrder');
//个人中心-订单细节
Route::get('home-personal-orderDetail',  'Home\PersonalController@orderDetail');
//个人中心-获取订单细节
Route::post('home-personal-getOrderGoods',  'Home\PersonalController@getOrderGoods');
//个人中心-取消订单
Route::post('home-personal-deleteOrder',  'Home\PersonalController@deleteOrder');
//个人中心-收货地址
Route::get('home-personal-userAddress',  'Home\PersonalController@userAddress');
//个人中心-获取收货地址信息
Route::post('home-personal-getUserAddress',  'Home\PersonalController@getUserAddress');
//个人中心-用户信息
Route::get('home-personal-userInfo',  'Home\PersonalController@userInfo');
//个人中心-获取用户信息
Route::post('home-personal-getUserInfo',  'Home\PersonalController@getUserInfo');
//个人中心-收货地址-市 默认
Route::post('home-personal-getDistrict',  'Home\PersonalController@getDistrict');
//个人中心-添加收货地址信息
Route::post('home-personal-addUserAddress',  'Home\PersonalController@addUserAddress');
//个人中心-修改收货地址信息
Route::post('home-personal-updateUserAddress',  'Home\PersonalController@updateUserAddress');
//个人中心-删除收货地址信息
Route::post('home-personal-deleteUserAddress',  'Home\PersonalController@deleteUserAddress');
//个人中心-修改用户信息
Route::post('home-personal-updateUserInfo',  'Home\PersonalController@updateUserInfo');
//个人中心-修改用户密码
Route::post('home-personal-updatePassword',  'Home\PersonalController@updatePassword');
