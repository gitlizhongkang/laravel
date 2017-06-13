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

        //获取商品评论的满意度
        $data['satisfaction'] = json_decode($this->getGoodsSatisfaction($goods_id), true);

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
     * @brief 添加单个商品评价
     * @param string $goods_id 商品ID
     * @return json
     */
    public function addComment()
    {
        $uid = Session::get('uid');
        $arr = Input::get('cmt');
        $arr = json_decode($arr,true);
        $goods_id = intval($arr['goods_id']);
        $goodsComment = new GoodsComment();
        $comment = $goodsComment -> where(['goods_id'=>$goods_id,'user_id'=>$uid])->where('add_time','>',strtotime(date('Ymd'))) -> first();
        if (!empty($comment)) {
            $data['error'] = 1;
            $data['msg'] = '一个账号一天内只能评论一次';
        } else {
            $goodsComment->user_id = $uid;
            $goodsComment->goods_id = $goods_id;
            $goodsComment->comment_desc = $arr['comment_desc'];
            $goodsComment->satisfaction = $arr['satisfaction'];
            $goodsComment->add_time = time();
            $res = $goodsComment->save();
            if ($res == true) {
                $data['error'] = 0;
                $data['msg'] = '评论成功';
            } else {
                $data['error'] = 2;
                $data['msg'] = '评论失败';
            }
        }

        return json_encode($data);
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
     * @brief 获取单个商品评价的满意度
     * @param string $goods_id 商品ID
     * @return json
     */
    public function getGoodsSatisfaction($goods_id = '')
    {
        if($goods_id == '') {
           $goods_id = Input::get()['goods_id'];
        }

        $goodsComment = new GoodsComment;
        $res['good'] = $goodsComment-> where(['goods_id'=>$goods_id,'satisfaction'=>5])->orwhere(['goods_id'=>$goods_id,'satisfaction'=>4])->count('comment_id');
        $res['commonly'] = $goodsComment-> where(['goods_id'=>$goods_id,'satisfaction'=>3])->count('comment_id');
        $res['bad'] = $goodsComment-> where(['goods_id'=>$goods_id,'satisfaction'=>2])->orwhere(['goods_id'=>$goods_id,'satisfaction'=>1])->count('comment_id');
        $res['all'] = $goodsComment-> where(['goods_id'=>$goods_id])->count('comment_id');

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
        -> where([['is_on_sale', 1], ['is_second', 0], ['is_point', 0]])-> orderBy('add_time') 
        -> offset(0) -> limit($limit) -> get() -> toArray();

        return json_encode($new);
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