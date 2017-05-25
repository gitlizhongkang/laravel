<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Cart;
use App\Models\GoodsSku;
use Illuminate\Support\Facades\Cookie;

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
	 */
    public function add()
    {
    	//接值
    	$sku_id = Input::get()['sku_id'];
    	$num = Input::get()['num'];
    	
    	echo $this->cartAdd($sku_id,$num);       
    }

    /**
		*@brief 添加购物车接口
	 */
    public function cartAdd($sku_id,$num)
    {
    	$data['add_time'] = time();
    	$data['sku_id'] = $sku_id;
        $data['num'] = $num;
        
        // $user_id = Session('user_id');
        $user_id = 1;
        
        if (empty($user_id)) {

        	$cookie = Cookie::get('cart');
        	if (empty($cookie)) {
        		$arr['sku_id'] = $data;
        		array_push($cookie, $data);
        	} else {
        		foreach ($cookie as $k => $v) {
	        		if ($k == $sku_id) {
	        			$a = 1;
	        			$cookie[$sku_id]['num'] += $num;        			
	        		}
	        	}

	        	if (!isset($a)) {
	        		$arr['sku_id'] = $data;
	        		array_push($cookie, $data);
	        	}

        	}
        	
			//添加cookiejkmnb 
        	Cookie::queue('cart', $arr);
        	$msg['error'] =0;
        } else {
        	//添加入库
        	$data['user_id'] = $user_id;
        	$cart = new Cart;
			$one = $cart->where([['user_id', $user_id], ['sku_id', $sku_id]])->first();
        	
        	//如果购物车已有数据，则修改数量，若没有则添加数据
        	if ($one) {
        		$one->num = $one->num + $num;
        		$res = $one->save();
        	}else{
        		$cart->fill($data);
        		$res = $cart->save();
        	}       	

			if ($res) {
				$msg['error'] =0;
			} else {
				$msg['error'] =1;
			}   
        }

    	return json_encode($msg);
    }

}
