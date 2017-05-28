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
    // 用户注册页面

    Route::get('home-user-register',  'Home\UserController@register');

    // 用户提交注册

    Route::post('home-user-commit',  'Home\UserController@commit');

    // 用户登录检查

    Route::post('home-user-loginCheck',  'Home\UserController@loginCheck');

    // 用户登录页面

    Route::get('home-user-login',  'Home\UserController@login');

    // 用户忘记密码页面

    Route::get('home-user-forgetPassword',  'Home\UserController@forgetPassword');

    // 用户找回密码页面

    Route::get('home-user-findPassword',  'Home\UserController@findPassword');

    // 第三方登录回调域

    Route::get('home-user-bind',  'Home\UserController@bind');

    // 用户绑定页面

    Route::get('home-user-babyBind',  'Home\UserController@babyBind');

    // 验证用户 发送邮箱

    Route::post('home-user-getPassword',  'Home\UserController@getPassword');

    // 重置密码

    Route::post('home-user-resetPassword',  'Home\UserController@resetPassword');

    // 发送验证码

    Route::any('home-user-send',  'Home\UserController@send');

    // 用户名-电话-邮箱唯一检测

    Route::get('home-user-uniqueCheck',  'Home\UserController@uniqueCheck');

    // 判断手机验证码

    Route::get('home-user-mobileCheck',  'Home\UserController@mobileCheck');

    // 验证码检测

    Route::get('home-user-codeCheck',  'Home\UserController@codeCheck');

    // 验证码

    Route::get("home-user-code",  'Home\UserController@code');

    // 早教音乐首页

    Route::get("home-music-index",  'Home\MusicController@index');

    // 单个音乐播放页

    Route::get("home-music-detail",  'Home\MusicController@detail');

});



//前台首页
Route::get('/', 'Home\IndexController@index');


//商品添加页面
Route::get('/admin-goods-addView', function (){
    return view('admin.goods-add');
});
Route::get('/admin-goods-category', 'Admin\GoodsController@category');
Route::get('/admin-goods-brand', 'Admin\GoodsController@brand');
Route::get('/admin-goods-normsName', 'Admin\GoodsController@normsName');
Route::get('/admin-goods-normsValue', 'Admin\GoodsController@normsValue');
Route::get('/admin-goods-createSku', 'Admin\GoodsController@createSku');
Route::get('/admin-goods-attributesType', 'Admin\GoodsController@attributesType');
Route::get('/admin-goods-attributes', 'Admin\GoodsController@attributes');
Route::post('/admin-goods-skuImg', 'Admin\GoodsController@skuImg');

//商品添加方法
Route::post('/admin-goods-add', 'Admin\GoodsController@add');



//商品列表页
Route::get('/home-goods-index', 'Home\GoodsController@index');


//商品详情页

Route::get('/home-goods-goodsInfo', 'Home\GoodsController@goodsInfo');


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

