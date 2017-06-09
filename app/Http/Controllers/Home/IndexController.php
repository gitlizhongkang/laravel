<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Redis;
use App\Models\Goods;
use Session;
use App\Models\UserBrowerLog;
use App\Models\GoodsSecond;

class IndexController extends Controller
{

	/*
    |--------------------------------------------------------------------------
    | Index Controller
    |--------------------------------------------------------------------------
    |
    | This controller is the first page to access
    |
    */
   


	/**
	 *@brief 首页展示
	 */
    public function index()
    {
    	
    	//获取最新的商品信息
    	$data['new'] = json_decode($this -> getGoodsNew(), true) ;

    	//获取秒杀的商品信息
    	$data['second'] = json_decode($this -> getGoodsSecond(6), true);

    	//猜你喜欢  如果登录获取用户浏览记录  如果没有显示最热商品
  //   	$user_id = 1;
		// $data['recommendation'] = json_decode($this -> getUserLike($user_id), true);

    	
    	return view('/home/index' , $data);
    }


    /**
     * @brief 获取分类
     * @return json
     */
    public function getCategory()
    {
    	if (!empty(Redis::get('category'))) {
    		$res = unserialize(Redis::get('category'));
    	} else {
    		$category = new Category;
    		$arr = $category->all()->toArray();
    		$res = $this->tree($arr);
    		$info = serialize($res);
    		Redis::set('category',$info);
    	}
    	
    	return json_encode($res);
    }


    /**
     * @brief 获取分类
     * @param array $arr['0'=>['category_id'=>1]]
     * @return array
     */
    public function tree($arr)
    {
    	foreach ($arr as $k=>$v) {
    		if ($v['parent_id'] == 0) {
    			$info[$v['category_name']] = [];

    			foreach ($arr as $k1=>$v1) {
    				if ($v1['parent_id'] == $v['category_id']) {
    					$info[$v['category_name']][$v1['category_name']] = [];

    					foreach ($arr as $k2=>$v2) {
		    				if ($v2['parent_id'] == $v1['category_id']) {
		    					$info[$v['category_name']][$v1['category_name']][] = $v2['category_name'];
		    				} 
		    			}
    				} 
    			}
    		}
    	}

    	
    	return $info;
    }

     /**
     * @brief 获取最新的商品信息
     * @return json
     */
    public function getGoodsNew()
    {
    	$goods = new Goods;

    	$new= $goods -> where('is_on_sale', '1')-> orderBy('add_time') 
    	-> offset(0) -> limit(6) -> get() -> toArray();

    	return json_encode($new);
    }

	/**
     * @brief 获取秒杀的商品信息
     * @param int $limit = 6 获取前六条数据
     * @return json
     */
    public function getGoodsSecond($limit)
    {
    	$second = new GoodsSecond;

    	$second = $second -> orderBy('start_time') 
    	-> offset(0)-> limit($limit) -> get() -> toArray();

    	return json_encode($second);
    }

    /**
     * @brief 获取用户浏览记录类似商品 猜你喜欢
     * @param int $user_id 用户ID
     * @return json
     */
    // public function getUserLike($user_id = '')
    // {
    	// if (!empty($user_id)) {
    	// 	$log = new UserBrowerLog;
    	// 	$res = $log -> select('category_id') -> where('user_id', $user_id) -> get() -> toArray();
    		
    	// 	if (!empty($res)) {
    	// 		//二维数组变为一维数组
    	// 		$category_id = array_column($res, 'category_id');

    	// 		$goods = new Goods;
	    // 		$recommendation = $goods -> whereIn('category_id',$category_id)
	    // 		->where('is_on_sale', '1') -> orderBy('add_time') 
	    // 		-> offset(0) -> limit(8) -> get() -> toArray();
    	// 	}
    	// } else {
    	// 	$recommendation = $goods -> where([['is_hot', '=', 1],['is_on_sale', '=', 1]]) 
    	//     -> orderBy('add_time') -> offset(0)
    	//     -> limit(8) -> get() -> toArray();
    	// }

    	// return json_encode($recommendation);
    // }


	
}
