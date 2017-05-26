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
    | This controller is a controller for the commodity of the website
    |
    */
   

	/**
		*@brief 商品详情页面
	 */
    public function goodsInfo()
    {
    	$goods_id = Input::all()['goods_id'];

        //获取商品信息
        $data['goodsInfo'] = json_decode($this->getGoodsInfo($goods_id), true);

        //获取商品规格信息
        $data['norms']= json_decode($this->getGoodsNorms($goods_id), true);

        //获取商品的属性信息
        $data['goodsAttr'] = json_decode($this->getGoodsAttr($goods_id), true);

        //获取商品的评论
        $data['comment'] = json_decode($this->getGoodsComment($goods_id), true);
        // dd($data['comment']);

    	return view('/home/goods',$data);
    }

    /**
     * @brief 显示单个商品所有评价页面
     * @param string $goods_id 商品ID
     * @return json
     */
    public function comment()
    {
        $goods_id = 1;
        $data['comment'] = $this->getGoodsComments($goods_id);
        $data['goods_id'] = $goods_id;

        return view('home/comment', $data);
    }

    /**
     * @brief 获取单个商品信息
     * @param string $goods_id 商品ID
     * @return json
     */
    public function getGoodsInfo($goods_id = '')
    {
        if ($goods_id =='') {
            $goods_id = Input::get()['goods_id'];           
        }

        $goods = new Goods;
        $res = $goods->find($goods_id);
        
        return json_encode($res);
    }

     /**
     * @brief 获取单个商品规格信息
     * @param string $goods_id 商品ID
     * @return json
     */
    public function getGoodsNorms($goods_id = '')
    {
        if ($goods_id =='') {
            $goods_id = Input::get()['goods_id'];           
        }

        $goodsNorms = new GoodsNorms;
        $res = $goodsNorms -> where('goods_id',$goods_id) -> get();
        foreach ($res as $k => $v) {
            $res[$k]['norms_value'] = explode(',', $v['norms_value']);
        }
        
        return json_encode($res);
    }

     /**
     * @brief 获取单个商品属性信息
     * @param string $goods_id 商品ID
     * @return json
     */
    public function getGoodsAttr($goods_id = '')
    {
        if ($goods_id =='') {
            $goods_id = Input::get()['goods_id'];           
        }

        $goodsAttr = new GoodsAttr;
        $res = $goodsAttr -> where('goods_id',$goods_id) -> get();
        foreach ($res as $k => $v) {
            $res[$k]['attr_value'] = explode(',', $v['attr_value']);
        }
        
        return json_encode($res);
    }

     /**
     * @brief 获取单个商品评价
     * @param string $goods_id 商品ID
     * @return json
     */
    public function getGoodsComment($goods_id = '')
    {
        if ($goods_id =='') {
            $goods_id = Input::get()['goods_id'];           
        }

        $goodsComment = new GoodsComment;
        $res = $goodsComment -> where('goods_id',$goods_id) -> orderBy('add_time') 
                -> offset(0) -> limit(10) -> get() -> toArray();
        
        return json_encode($res);
    }

    /**
     * @brief 获取单个商品所有评价
     * @param string $goods_id 商品ID
     * @return array
     */
    public function getGoodsComments($goods_id = '')
    {
        if ($goods_id =='') {
            $goods_id = Input::get()['goods_id'];           
        }
        
        $goodsComment = new GoodsComment;
        $res = $goodsComment -> where('goods_id',$goods_id) -> paginate(5);
        
        return $res;
    }

    


    /**
     * @brief 获取单个商品选中的sku
     * @param string $goods_id 商品ID 
     * @param string $norms_value  sku规格值
     * @return json
     */
    public function getSku()
    {
        $goods_id = Input::get()['goods_id'];
        $norms_value = Input::all()['norms_value'];

        $sku = new GoodsSku;
        $res = $sku -> select('sku_id','sku_sn','sku_price','sku_img','sku_num')
        -> where([['goods_id', $goods_id],['sku_norms', $norms_value]]) -> first();

        echo json_encode($res);
    }

    /**
     * @brief 商品列表
     */
    public function index()
    {
        return view('home/goods-list');
    }

}