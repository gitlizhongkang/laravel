<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

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

    	return view('/home/index' , $data);
    }


    /**
     * @brief 获取分类
     * @return array
     */
    public function getCategory()
    {
    	$category = new Category;
    	$arr = $category->all()->toArray();
    	$res = $this->tree($arr);

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
