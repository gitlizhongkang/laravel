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
Route::get('/admin-goods-add', 'Admin\GoodsController@add');


//商品列表页
Route::get('/home-goods-index', 'Home\GoodsController@index');


//商品详情页
Route::get('/home-goods-goodsInfo', 'Home\GoodsController@goodsInfo');
