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
