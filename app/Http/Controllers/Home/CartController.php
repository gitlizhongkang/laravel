<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Cart;
use App\Models\GoodsSku;
use Illuminate\Support\Facades\Cookie;
use Session;
use App\Models\UserBrowerLog;
use Illuminate\Support\Facades\Redis;

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
        $data = Input::get();
        unset($data['_token']);	
    	$data['add_time'] = time();
         
        //判断用户是否登录，若没有登录存入cookie，否则就入库     
        $user_id = Session::get('uid');        
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

            Cookie::queue('cart',$cookie);
            $msg['error'] = 0;       	
        } else {
            //如果购物车已有数据，则修改数量，若没有则添加数据  
        	$key = 'cart'.$user_id;
            $arr = unserialize(Redis::get($key));
            if (isset($arr[$data['sku_id']])) {
                $arr[$data['sku_id']]['status'] = 2;
                $arr[$data['sku_id']]['num'] =  $arr[$data['sku_id']]['num'] + $data['num'];
            } else {
                $data['status'] = 3;
                $arr[$data['sku_id']] = $data;
            }

            if (Redis::set($key,serialize($arr))) {
                $msg['error'] = 0;

                //添加浏览记录表
                $info['category_id'] = Input::get()['category_id'];
                $info['user_id'] = $user_id;
                $info['add_time'] = time();
                $log = new UserBrowerLog;
                
                $cate = $log->select('category_id')->where('user_id',$user_id)->first();
                if ($cate == '') {
                    $log->fill($info);
                    $log->save();
                } else {
                    $category = explode(',',$cate->category_id);
                    if(count($category)<3) {
                        array_push($category,$info['category_id']);
                        
                    } else {
                        $category[0] = $info['category_id'];
                    }

                    $category = implode(',', $category);
                    $log->where('user_id',$user_id)->update(['category_id'=>$category]);
                }               
            } else {
                 $msg['error'] = 1;
            }										
        }

    	return json_encode($msg);   
    }

	/**
		*@brief 购物车页面
	 */
    public function index()
    {
        $cart = json_decode($this->getCart(), true);
        $cart['total_price'] = 0;
        if (!empty($cart['data'])) {
            foreach ($cart['data'] as $k=>$v) {
                if (isset($v['status'])) {
                    if($v['status'] != 4) {
                        $cart['total_price'] += $v['sku_price']*$v['num'];
                        $cart['data'][$k]['num_price'] = $v['sku_price']*$v['num'];
                    } else {
                        unset($cart['data'][$k]);
                    } 
                } else {
                    $cart['total_price'] += $v['sku_price']*$v['num'];
                    $cart['data'][$k]['num_price'] = $v['sku_price']*$v['num'];
                }
                           
            }
        }
        
    	return view('home/cart',$cart);

    }

    /**
        *@brief 获取购物车
        *@param string $limit  
        *@return   json  
     */
    public function getCart()
    {
        $limit = Input::all('limit');
        $user_id = '';
        $data = [];
        $count = 0;
        if (!Session::has('uid')) {    
            $data = Cookie::get('cart');
            if (!empty($data)) {               
               $count = count($data);
                if (!empty($limit)) {
                    $num = 0;
                    foreach ($data as $k => $v) {
                       if ($num>2) {
                            unset($data[$k]);
                       }
                       $num ++;
                    }
                }      
            }                   
        } else {
            $user_id = Session::get('uid');
            $cart = new Cart;
            $key = 'cart'.$user_id;
            
            //若内存没有 查库存内存，若有直接获取
            if (Redis::get($key)) {
                $data = unserialize(Redis::get($key));               
            } else {
                $arr = $cart->select('cart.cart_id', 'goods_sku.sku_img','cart.num','goods_sku.goods_name','goods_sku.sku_price','cart.sku_id','goods_sku.goods_id','goods_sku.sku_norms')
                ->join('goods_sku','goods_sku.sku_id','=','cart.sku_id')
                ->where('cart.user_id',$user_id)->orderBy('add_time','desc')->get()->toArray();
                
                foreach ($arr as $k => $v) {
                   $data[$v['sku_id']] = $v;
                   $data[$v['sku_id']]['status'] = 1;
                }
                $info = serialize($data);
                Redis::set($key,$info);
            }

            if (!empty($limit)) {
                $num = 0;
                foreach ($data as $key => $value) {
                    if ($value['status'] != 4) {
                        $num++;
                        if ($num>3) {
                            unset($data[$key]);
                        }
                    } else {
                        unset($data[$key]);
                    }                    
                }
            }
        }
        $count = count($data);
        $res['data'] = $data;
        $res['count'] = $count;   
       
        return json_encode($res);       
    }

     /**
        *@brief 获取购物车
        *@param string $sku_id
        *@param string $num 
        *@return   json  
     */
    public function updateNum()
    {
        $sku_id = Input::get()['sku_id'];
        $num = Input::get()['num'];

        $sku = new GoodsSku();
        $sku_num = $sku->select('sku_num')->find($sku_id);
        if ($sku_num['sku_num'] < $num) {
            $msg['message'] = '库存不足';
            $msg['error'] = 1;

        } else {
            //判断用户是否登录，若没有登录存入cookie，否则就入库     
            $user_id = Session::get('uid');   
            $msg['total_price'] =0;   
            $key = 'cart'.$user_id;  
            if (empty($user_id)) {
                $arr = Cookie::get('cart'); 
                $arr[$sku_id]['num'] = $num; 
                $res = Cookie::queue('cart',$arr);  
                $msg['error'] = 0;               
            } else {               
                $arr = unserialize(Redis::get($key));
                $arr[$sku_id]['status'] = 2;  
                $arr[$sku_id]['num'] = $num; 
                $res = Redis::set($key,serialize($arr));
                if ($res) {
                    $msg['error'] = 0;                            
                } else {
                    $msg['error'] = 1;
                }                                                                      
            }
            
            foreach ($arr as $k => $v) {
                $msg['total_price'] += $v['num']*$v['sku_price'];
            } 

            $price = $arr[$sku_id]['sku_price'];
            $msg['sku_id'] = $sku_id;
            $msg['num'] = $num;
            $msg['num_price'] = $num * $price;           
        }
       

        return json_encode($msg);   
    }

     /**
        *@brief 删除购物车中的商品
        *@param string $sku_id
        *@param string $num 
        *@return   json  
     */
    public function delOne()
    {
        $sku_id = Input::get()['sku_id'];
       
        //判断用户是否登录    
        $user_id = Session::get('uid');   
        $msg['total_price'] =0;     
        
        if (empty($user_id)) {
            $arr = Cookie::get('cart'); 
            if ($sku_id == 'all') {
                $res = Cookie::queue('cart','');
            } else {
                unset($arr[$sku_id]);   
                $res = Cookie::queue('cart',$arr);      
            }                 
        } else {
            $key = 'cart'.$user_id;
            $arr = unserialize(Redis::get($key));
            if ($sku_id == 'all') {
               foreach ($arr as $k => $v) {
                   $arr[$k]['status'] = 4;
               }               
            } else {
                $arr[$sku_id]['status'] = 4;                
            }
             $res = Redis::set($key,serialize($arr));                                                                 
        }


        return redirect('/home-cart-index');  
    }
}
