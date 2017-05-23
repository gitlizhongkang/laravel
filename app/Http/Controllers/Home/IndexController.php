<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Redis;
use App\Models\Goods;

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
    	//获取分类列表
    	$data['category'] = $this->getCategory();
    	$goods = new Goods;
    	$data['milk'] = $goods -> where('category_id','in','25,26,27,28') 
    	-> orderBy('add_time') -> offset(0)
    	-> limit(10) -> get() -> toArray();
    	$data['diapers'] = $goods -> where('category_id','in','31,32,33,35') 
    	-> orderBy('add_time') -> offset(0)
    	-> limit(10) -> get() -> toArray();

    	return view('/home/index' , $data);
    }


    /**
     * @brief 获取分类
     * @return array
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
    	
    	return $res;
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
