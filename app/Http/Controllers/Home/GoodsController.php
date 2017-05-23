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
use App\Models\GoodsNorms;

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
        $goods = new Goods;
        $goodsAttr = new GoodsAttr;
        $goodsNorms = new GoodsNorms;
    	$goods_id = 1;

        //获取商品信息
        $data['goodsInfo'] = $goods->find($goods_id);


        //获取商品规格信息
        $data['norms']= $goodsNorms->all()->where('goods_id',$goods_id);
        foreach ($data['norms'] as $k => $v) {
            $data['norms'][$k]['norms_value'] = explode(',', $v['norms_value']);
        }

        // dd($data['norms']);
        $data['goodsAttr'] = $goodsAttr->all()->where('goods_id',$goods_id);
    	return view('/home/goods',$data);
    }
}