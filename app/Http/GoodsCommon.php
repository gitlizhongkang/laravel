<?php

namespace App\Http;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Models\Goods;
use App\Models\GoodsAttr;
use App\Models\GoodsImg;
use App\Models\GoodsSku;
use App\Models\GoodsComment;
use App\Models\GoodsNorms;
use App\Models\Category;
use Illuminate\Support\Facades\Redis;
use App\Models\GoodsSecond;
use App\Models\UserBrowerLog;
use Session;
use App\Models\Brand;
use Carbon\Carbon;

trait GoodsCommon
{
	/**
     * @brief 获取最新的商品信息
     * @param int $limit = 6 获取前六条数据
     * @return json
     */
    public function getNew($limit = '')
    {
        if ($limit == '') {
             $limit = Input::all()['limit'];
        }       
        $goods = new Goods;

        $new= $goods -> select('goods_id','goods_name','goods_img','goods_low_price','category_name','brand_name')
        -> where([['is_on_sale', 1], ['is_second', 0], ['is_point', 0]])-> orderBy('goods_sale_num','desc') 
        -> offset(0) -> limit($limit) -> get() -> toArray();

        return json_encode($new);
    }

    
    /**
     * @brief 获取秒杀的商品信息
     * @param int $limit = 6 获取前六条数据
     * @return json
     */
    public function getSecond($limit = '')
    {
        if ($limit == '') {
             $limit = Input::all()['limit'];
        } 
        $second = new GoodsSecond;

        $time = date("Y-m-d",time());
        $second = $second -> select('goods_id','goods_name','goods_img','original_price','category_name','brand_name','second_price','start_time') 
        -> where('start_time','<=',$time) -> orderBy('start_time') 
        -> offset(0)-> limit($limit) -> get() -> toArray();

        return json_encode($second);
    }

     /**
     * @brief 获取用户浏览记录类似商品 猜你喜欢
     * @param int $limit = 6 获取前六条数据
     * @param int $user_id 用户ID
     * @return json
     */
    public function getUserLike($user_id = '0',$limit = '')
    {
        if ($user_id == '0') {
            $user_id = Input::all()['user_id'];
        }        
        if ($limit == '') {
             $limit = Input::all()['limit'];
        } 

        $goods = new Goods;
        if (!empty($user_id)) {

            $log = new UserBrowerLog;
            $res = $log -> select('category_id') -> where('user_id', $user_id) -> get() -> toArray();
            if (!empty($res)) {
                //二维数组变为一维数组
                $category_id = array_column($res, 'category_id');
//                 dd($category_id);

                $recommendation = $goods 
                -> select('goods_id','goods_name','goods_img','goods_low_price','category_name','brand_name') 
                -> whereIn('category_id',$category_id)->where([['is_on_sale', 1], ['is_second', 0], ['is_point', 0]]) 
                -> orderBy('add_time') -> offset(0) -> limit($limit) -> get() -> toArray();
            } else {
                $recommendation = $goods 
                -> select('goods_id','goods_name','goods_img','goods_low_price','category_name','brand_name')
                -> where([['is_hot', 1],['is_on_sale', 1], ['is_second',0]])
                -> orderBy('add_time') -> offset(0)-> limit($limit) -> get() -> toArray();
            }
        } else {
            $recommendation = $goods 
            -> select('goods_id','goods_name','goods_img','goods_low_price','category_name','brand_name') 
            -> where([['is_hot', 1],['is_on_sale', 1], ['is_second',0], ['is_point', 0]]) 
            -> orderBy('add_time') -> offset(0)-> limit($limit) -> get() -> toArray();

        }

        return json_encode($recommendation);
    }

       /**
     * @brief 获取单个商品信息
     * @param string $goods_id 商品ID
     * @return json
     */
    public function getGoodsInfo($goods_id = '')
    {
        if($goods_id == '') {
           $goods_id = Input::get()['goods_id'];   
        } 
                  

        $goods = new Goods;
        $res = $goods->select('goods_id','goods_name','goods_img','category_id','is_second','category_name','goods_low_price','goods_desc','brand_name','goods_point')->find($goods_id);
        
        return json_encode($res);
    }

     /**
     * @brief 获取单个商品规格信息
     * @param string $goods_id 商品ID
     * @return json
     */
    public function getGoodsNorms($goods_id = '')
    {
        if($goods_id == '') {
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
       if($goods_id == '') {
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
     * @brief 获取单个商品的所有图片
     * @param string $goods_id 商品ID 
     * @return json
     */
    public function getGoodsImg($goods_id = '')
    {
       if($goods_id == '') {
           $goods_id = Input::get()['goods_id'];   
        }      

        $goodsImg = new GoodsImg;
        $res = $goodsImg ->select('img_url')-> where('goods_id',$goods_id) -> get();
        
        return json_encode($res);
    }

     /**
     * @brief 获取单个商品评价
     * @param string $goods_id 商品ID
     * @return json
     */
    public function getGoodsComment($goods_id = '')
    {
        if($goods_id == '') {
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
        if($goods_id == '') {
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

        // echo $norms_value;die;
        $sku = new GoodsSku;
        $res = $sku -> select('sku_id','sku_sn','sku_price','sku_img','sku_num')
        -> where([['goods_id', $goods_id],['sku_norms', $norms_value]]) -> first();

        return json_encode($res);
    }

    /**
     * @brief 获取分类商品
     * @param string $goods_id 商品ID 
     * @return json
     */
    public function getCate($category_name = '')
    {
        if($category_name == ''){
            $category_name = Input::get()['category_name'];
        }

        $where = '1=1';       
        if (!empty($category_name)) {
            $category = unserialize(Redis::get('category'));
            $names = '';
            foreach ($category as $k => $v) {
                if ($k == $category_name) {
                    $names .= $category_name . ',';
                    if (!empty($v)) {
                        foreach ($v as $k1 => $v1) {
                            $names .= $k1 . ',';
                            if (!empty($v1)) {
                                foreach ($v1 as $k2 => $v2) {
                                    $names .= $v2 . ',';
                                }
                            }                      
                        }
                    }
                } else {
                    foreach ($v as $k1 => $v1) {
                        if ($k1 == $category_name) {
                            $names .= $k1 . ',';
                            if (!empty($v1)) {
                                foreach ($v1 as $k2 => $v2) {
                                    $names .= $v2 . ',';
                                } 
                            }                           
                        } else {
                             foreach ($v1 as $k2 => $v2) {
                                if ($v2 == $category_name) {
                                     $names .= $v2 .  ',';
                                }                             
                            }
                        }                      
                    }
                }
            }
        }  
        
        $len = strlen($names);
        $names = substr($names, 0, $len-1);
        $names = explode(',', $names);
       
       return $names;

    }

    /**
     * @brief 获取分类品牌
     * @return json
     */
    public function getCateBrand($category_name = '')
    {
        if ($category_name == '') {
            $category_name = Input::get('category_name');
        }
        
        $category_name = $this->getParentCate($category_name);
        $brand = new brand;
        $arr = $brand->select('brand_name')->where('category_name',$category_name)->get();

        return json_encode($arr);
    }

     /**
     * @brief 获取顶级分类
     * @return string
     */
    public function getParentCate($category_name)
    {
        if (Redis::exists('category')) {
            $cate = unserialize(Redis::get('category'));
            foreach ($cate as $k => $v) {
                if($k != $category_name){
                    foreach ($v as $k1 => $v1) {
                       if ($k != $category_name) {
                            if (in_array($category_name, $v1)) {
                                $category_name = $k;
                            }
                       } else {
                            $category_name = $k;
                       }
                    }
                }
            }
        }

        return $category_name;
    }
}