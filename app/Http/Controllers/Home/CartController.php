<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Cart;
use App\Models\GoodsSku;
use Illuminate\Support\Facades\Cookie;
use Session;

class CartController extends Controller
{
	/*
    |--------------------------------------------------------------------------
    | Goods Controller
    |--------------------------------------------------------------------------
    |
    | This controller is the shopping cart that manages the merchandise
    |
    */

	/**
		*@brief 添加购物车
		*@param string $sku_id 商品sku
		*@param string $num  购买数量
		*@param string $category_id  商品id
		*@return   json  error:0 添加成功  error:1 添加失败
	 */
    public function add()
    {
    	//接值   	
    	$data['add_time'] = time();
    	$data['sku_id'] = Input::get()['sku_id'];
        $data['num'] = Input::get()['num'];
         
        //判断用户是否登录，若没有登录存入cookie，否则就入库     
        $user_id = Session('uid');        
        if (empty($user_id)) {
        	$cookie = Cookie::get('cart');       	
        	
        	//如果cookie已有数据，则修改数量，若没有则添加数据 
        	if (empty($cookie)) {
        		$cookie[$data['sku_id']] = $data;
        	} else {
        		foreach ($cookie as $k => $v) {
	        		if ($k == $data['sku_id']) {
	        			$a = 1;
	        			$cookie[$k]['num'] += $data['num'];        			
	        		}
	        	}
	        	if (!isset($a)) {
	        		$cookie[$data['sku_id']] = $data;
	        	}
        	}
        	
        	Cookie::queue('cart', $cookie);
        	$msg['error'] =0;
        } else {
        	//添加入库
        	$data['user_id'] = $user_id;
        	$cart = new Cart;
			$one = $cart->where([['user_id', $user_id], ['sku_id', $data['sku_id']]])->first();
        	
        	//如果购物车已有数据，则修改数量，若没有则添加数据
        	if ($one) {
        		$one->num = $one->num + $data['num'];
        		$res = $one->save();
        	}else{
        		$cart->fill($data);
        		$res = $cart->save();
        	}       	
			if ($res) {
				$msg['error'] =0;
				
				//添加浏览记录表
				$info['category_id'] = Input::get()['category_id'];
				$info['user_id'] = $user_id;
				$info['add_time'] = time();
				$log = new UerBrowerLog;
				$count = $re->where('user_id',$user_id)->count();
				
				//如果浏览记录小于3则继续添加，否则替换掉最旧的那个
				if($count < 3){
					$log->fill($info);
					$log->save();
				} else {
					$re = $log ->select('category_id')->where('user_id',$user_id)->orderBy('add_time')->first();
					$re->category_id = $info['category_id'];
					$re->save();
				}				
				
			} else {
				$msg['error'] =1;
			}   
        }

    	echo json_encode($msg);       
    }

	/**
		*@brief 购物车页面
	 */
    public function index()
    {
    	Session::flush();
    	// Session::forget('aa');
    	// Session::put('aa','1');
    	echo Session::get('aa');

    }

}
