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
        $data['goodsInfo'] = json_decode(CommonController::curl('home-goods-getGoodsInfo', ['goods_id'=>$goods_id]), true);

        //获取商品规格信息
        $data['norms']= json_decode(CommonController::curl('home-goods-getGoodsNorms', ['goods_id'=>$goods_id]), true);

        //获取商品的属性信息
        $data['goodsAttr'] = json_decode(CommonController::curl('home-goods-getGoodsAttr', ['goods_id'=>$goods_id]), true);

        //获取商品的评论
        $data['comment'] = json_decode(CommonController::curl('home-goods-getGoodsComment', ['goods_id'=>$goods_id]), true);

        //获取商品的图片
        $data['img'] = json_decode(CommonController::curl('home-goods-getGoodsImg', ['goods_id'=>$goods_id]), true);
        // dd($data['img']);

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
    public function getGoodsInfo()
    {
        $goods_id = Input::get()['goods_id'];           

        $goods = new Goods;
        $res = $goods->select('goods_id','goods_name','goods_img','category_id','is_second','category_name','goods_low_price','goods_desc','brand_name')->find($goods_id);
        
        return json_encode($res);
    }

     /**
     * @brief 获取单个商品规格信息
     * @param string $goods_id 商品ID
     * @return json
     */
    public function getGoodsNorms($goods_id = '')
    {
        $goods_id = Input::get()['goods_id'];

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
    public function getGoodsAttr()
    {
        $goods_id = Input::get()['goods_id'];           

        $goodsAttr = new GoodsAttr;
        $res = $goodsAttr -> where('goods_id',$goods_id) -> get();
        foreach ($res as $k => $v) {
            $res[$k]['attr_value'] = explode(',', $v['attr_value']);
        }
        
        return json_encode($res);
    }

    /**
     * @brief 获取单个商品的所有图片
     * @param string $goods_id 商品ID 
     * @return json
     */
    public function getGoodsImg()
    {
        $goods_id = Input::get()['goods_id'];           

        $goodsImg = new GoodsImg;
        $res = $goodsImg ->select('img_url')-> where('goods_id',$goods_id) -> get();
        
        return json_encode($res);
    }

     /**
     * @brief 获取单个商品评价
     * @param string $goods_id 商品ID
     * @return json
     */
    public function getGoodsComment()
    {
        $goods_id = Input::get()['goods_id'];           

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
    public function getGoodsComments()
    {
        $goods_id = Input::get()['goods_id'];           
        
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

        return json_encode($res);
    }

    /**
     * @brief 商品列表
     */
    public function index()
    {
        //接值
        $category_id = Input::get()['category_id'];

        return view('home/goods-list');
    }

    /**
     * @brief 获取分类商品
     * @param string $goods_id 商品ID 
     * @return json
     */
    public function getCateGoods()
    {
        $category_id = Input::get()['category_id'];

        $where = '1=1';
        if (empty($category_id)) {
            $category = new Category;
        }   

        $goods = new Goods;
        $arr = $goods->$goods->select('goods_id','goods_name','goods_img','category_id','is_second','category_name','goods_low_price','goods_desc','brand_name')->whereIn('category_id',$ids)->get();

    }

    /**
     * @brief 获取最新的商品信息
     * @param int $limit = 6 获取前六条数据
     * @return json
     */
    public function getNew()
    {
        $limit = Input::all()['limit'];
        $goods = new Goods;

        $new= $goods -> select('goods_id','goods_name','goods_img','goods_low_price','category_name','brand_name')
        -> where('is_on_sale', '1')-> orderBy('add_time') 
        -> offset(0) -> limit($limit) -> get() -> toArray();

        return json_encode($new);
    }

    
    /**
     * @brief 获取秒杀的商品信息
     * @param int $limit = 6 获取前六条数据
     * @return json
     */
    public function getSecond()
    {
        $limit = Input::all()['limit'];
        $second = new GoodsSecond;

        $time = time()+3*24*60*60;
        $second = $second -> select('goods_id','goods_name','goods_img','goods_low_price','category_name','brand_name') 
        -> where('start_time','<',$time) -> orderBy('start_time') 
        -> offset(0)-> limit($limit) -> get() -> toArray();

        return json_encode($second);
    }

    /**
     * @brief 获取用户浏览记录类似商品 猜你喜欢
     * @param int $limit = 6 获取前六条数据
     * @param int $user_id 用户ID
     * @return json
     */
    public function getUserLike()
    {
        $user_id = Input::all()['user_id'];
        $limit = Input::all()['limit'];
        $goods = new Goods;
        if (!empty($user_id)) {

            $log = new UserBrowerLog;
            $res = $log -> select('category_id') -> where('user_id', $user_id) -> get() -> toArray();
            
            if (!empty($res)) {
                //二维数组变为一维数组
                $category_id = array_column($res, 'category_id');
              
                $recommendation = $goods -> select('goods_id','goods_name','goods_img','goods_low_price','category_name','brand_name') 
                -> whereIn('category_id',$category_id)->where('is_on_sale', '1') -> orderBy('add_time') 
                -> offset(0) -> limit($limit) -> get() -> toArray();
            }           
        } else {
            $recommendation = $goods -> select('goods_id','goods_name','goods_img','goods_low_price','category_name','brand_name') 
            -> where([['is_hot', 1],['is_on_sale', 1]]) 
            -> orderBy('add_time') -> offset(0)
            -> limit($limit) -> get() -> toArray();
        }

        return json_encode($recommendation);
    }
}