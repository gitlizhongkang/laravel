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
Route::auth();

//前台首页
Route::get('/',  'Home\IndexController@index');
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
 
 