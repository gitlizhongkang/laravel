<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Goods;
use App\Models\GoodsAttr;
use App\Models\GoodsImg;
use App\Models\GoodsSku;
use App\Models\GoodsComment;

class GoodsController extends Controller
{
	/*
    |--------------------------------------------------------------------------
    | Goods Controller
    |--------------------------------------------------------------------------
    |
    | This controller is the first page to access
    |
    */
   

	/**
		*@brief 商品详情页面
	 */
    public function goodsInfo()
    {
    	// $goods_id = Input::all()['goods_id'];
    	$goods_id = 

    	return view('/home/goods');
    }
}