<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redis;
use Session;
use App\Models\Goods;
use App\Http\GoodsCommon;

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
   
    use GoodsCommon;
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

        //获取商品的图片
        $data['img'] = json_decode($this->getGoodsImg($goods_id), true);
        // dd($data['img']);
        if ($data['goodsInfo']['is_second'] == 1) {
            // return view('/home/goods-second',$data);
            return 1;
        }

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
     * @brief 商品列表页
     * @param string $category_name 
     * @return json
     */
    public function goodsList()
    {
        //接值
        $category_name = isset(Input::all()['category_name'])?Input::all()['category_name']:'';
        $key = isset(Input::all()['key'])?Input::all()['key']:'';
        $brand_name =  isset(Input::all()['brand_name'])?Input::all()['brand_name']:'';
        $price_min =  isset(Input::all()['price_min'])?Input::all()['price_min']:'';
        $price_max =  isset(Input::all()['price_max'])?Input::all()['price_max']:'';
        $order =  isset(Input::all()['order'])?Input::all()['order']:'';

        $goods = new goods;
        $select = $goods->select('goods_id','goods_name','goods_img','category_id','is_second','category_name','goods_low_price','goods_desc','brand_name');
        
        $data['brand'] = '';
        if ($category_name != '') {
            $names = $this->getCate($category_name);
            $select = $select->whereIn('category_name', $names);

            $data['brand'] = json_decode($this->getCateBrand($category_name), true);
        }
        
        if ($key != '') {
            $select = $select->where('goods_name', 'like', "%$key%")
            ->orWhere('brand_name', 'like', "%$key%")->orWhere('category_name', 'like', "%$key%");
        }
        
        if ($brand_name != '') {
             $select = $select->where('brand_name', $brand_name);           
        }

        if ($price_min !='' && $price_max != '') {
            $select = $select->whereBetween('goods_low_price', [$price_min, $price_max]);           
        }

        if ($order != '') {
            if ($order == 'up') {
                $select = $select->orderBy('goods_low_price');
            } elseif ($order == 'down') {
                $select = $select->orderBy('goods_low_price', 'desc');
            }                    
        } else {
             $select = $select->orderBy('goods_sale_num', 'desc');
        }

        $data['goods'] = $select->where([['is_on_sale', 1], ['is_second', 0], ['is_point', 0]]) 
        ->paginate(2);
        
        if ($data['brand'] == '') {
            $category_name = $data['goods'][0]['category_name'] ;
            $data['brand'] = json_decode($this->getCateBrand($category_name), true);
        }
        // dd($data['goods']);
        //猜你喜欢
        $user_id = '';
        if (Session::has('uid')) {
            $user_id = Session::get('uid');
        }
        $data['userLike'] = json_decode($this->getUserLike($user_id, 5), true);
        
        $data['param']['category_name'] = $category_name;
        $data['param']['brand_name'] = $brand_name;
        $data['param']['price_min'] = $price_min;
        $data['param']['price_max'] = $price_max;
        $data['param']['key'] = $key;
        $data['param']['order'] = $order;


        return view('home/goods-list',$data);
    }


     
}