<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Redis;
use Session;
use App\Http\Controllers\Home\CommonController;

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
    	$data['new'] = json_decode(CommonController::curl('home-goods-getNew', ['limit'=>6]), true) ;

    	//获取秒杀的商品信息
    	$data['second'] = json_decode(CommonController::curl('home-goods-getSecond', ['limit'=>6]), true);
        // dd($data['second']);

    	//猜你喜欢  如果登录获取用户浏览记录  如果没有显示最热商品
        $user_id = '';
        if (Session::has('uid')) {
            $user_id = Session::get('uid');
        }
   	
		$data['recommendation'] = json_decode(CommonController::curl('home-goods-getUserLike', ['user_id'=>$user_id,'limit'=>8]), true);

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

   

	

    


	
}
