<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\OrderGoods;
use App\Models\User;
use App\Models\Order;

class StatsController extends Controller
{

	/**
     * @brief 商品统计
     */
	public function goods(){

		return view('admin.stats-goods');
	}

	/**
     * @brief 获取商品统计
     * @param start_time 
     * @param end_time
     * @param goods_name  商品名称或货号
     * @return json 商品信息 
     */
	public function getGoods(){
		//接值
		$start_time = isset(Input::get()['start_time'])?strtotime(Input::get()['start_time']):'';
		$end_time = isset(Input::get()['end_time'])?strtotime(Input::get()['end_time']):'';
		$goods_name = isset(Input::get()['goods_name'])?Input::get()['goods_name']:'';

		if ($start_time == '' || $end_time == '') {
			$msg['error'] = 1000;
			$msg['message'] = '请输入查询范围';
		}
		if ($goods_name == '') {
			$msg['error'] = 1000;
			$msg['message'] = '请输入商品名称';
		} 
		
		$order = new OrderGoods;
		$arr = $order->select('sk_norms_value', 'num','add_time')
		->whereBetween('add_time', [$start_time, $end_time])->where('goods_name', $goods_name)
		->get()->toArray();	
		
		//将日期排序
		$len = ($end_time-$start_time)/60/60/24;
		$start = date('Y-m-d', $start_time);
		for ($i=1;$i<=$len;$i++) {
			$next = date('Y-m-d', $start_time + 60*60*24*$i);
			$date[] = $next;
		}

		//处理数据
		$info = [];
		foreach ($arr as $k => $v) {
			$add_time = date('Y-m-d',$v['add_time']);
			foreach ($date as $k2 => $v2) {
				$info[$v['sku_norms_value']][$v2] = 0;
			}
			$info[$v['sku_norms_value']][$add_time] = $v['num'];
			unset($arr[$k]);
			foreach ($arr as $k1 => $v1) {
				$add_time1 = date('Y-m-d',$v1['add_time']);
				if (isset($info[$v1['sku_norms_value']])) {
					if (isset($info[$v1['sku_norms_value']][$add_time1])) {
						$info[$v1['sku_norms_value']][$add_time1] += $v1['num'];
					} else {
						$info[$v1['sku_norms_value']][$add_time1] = $v1['num'];
					}
				} else {
					$info[$v1['sku_norms_value']][$add_time1] = $v1['num'];
				}
				unset($arr[$k1]);				
			}			
		}
		
		$res = [];
		$num = 0;
		foreach ($info as $k => $v) {			
			$res[$num]['name'] = $k;
			$res[$num]['data'] = [];
			foreach ($v as $k1 => $v1) {
				$res[$num]['data'][] = $v1;
			}
			$num ++;									
		}
		// dd($res);		
		$msg['error'] = 0;
		$msg['data'] = $res;
		$msg['date'] = $date;

		return json_encode($msg);		
	}

	/**
     * @brief 用户注册统计
     */
	public function user(){

		return view('admin.stats-user');
	}

	/**
     * @brief 获取用户注册量
     * @param start_time 
     * @param end_time
     * @return json  用户注册量
     */
	public function getUser(){
		//接值
		$start_time = isset(Input::get()['start_time'])?strtotime(Input::get()['start_time']):'';
		$end_time = isset(Input::get()['end_time'])?strtotime(Input::get()['end_time']):'';
		if ($start_time == '' || $end_time == '') {
			$msg['error'] = 1000;
			$msg['message'] = '请输入查询范围';
		}

		$user = new User;

		//将日期排序
		$len = ($end_time-$start_time)/60/60/24;
		for ($i=0;$i<=$len;$i++) {
			$next = date('Y-m-d', $start_time + 60*60*24*$i);
			$date[] = $next;
		}

		$info = [];		
		foreach ($date as $k => $v) {
			$min = strtotime($v);
			$max = $min+60*60*24;
			$info[$v] = $user->whereBetween('reg_time', [$min, $max])->count('user_id');
		}

		$res[0] = ['name'=>'user'];
		foreach ($info as $k => $v) {
			$res[0]['data'][] = $v;
		}

		$msg['error'] = 0;
		$msg['data'] = $res;
		$msg['date'] = $date;

		echo json_encode($msg);
	}

	/**
     * @brief 用户注册统计
     */
	public function order(){

		return view('admin.stats-order');
	}

	/**
     * @brief 获取订单成交量
     * @param start_time 
     * @param end_time
     * @return json  订单成交量
     */
	public function getOrder(){
		//接值
		$start_time = isset(Input::get()['start_time'])?strtotime(Input::get()['start_time']):'';
		$end_time = isset(Input::get()['end_time'])?strtotime(Input::get()['end_time']):'';

		if ($start_time == '' || $end_time == '') {
			$msg['error'] = 1000;
			$msg['message'] = '请输入查询范围';
		}

		$order = new Order;

		//将日期排序
		$len = ($end_time-$start_time)/60/60/24;
		for ($i=0;$i<=$len;$i++) {
			$next = date('Y-m-d', $start_time + 60*60*24*$i);
			$date[] = $next;
		}

		$info = [];
		foreach ($date as $k => $v) {
			$min = strtotime($v);
			$max = $min+60*60*24;
			$info[$v] = $order->whereBetween('order_time', [$min, $max])->count('order_id');
		}
		
		$res[0] = ['name'=>'order'];
		foreach ($info as $k => $v) {
			$res[0]['data'][] = $v;
		}

		$msg['error'] = 0;
		$msg['data'] = $res;
		$msg['date'] = $date;

		echo json_encode($msg);
	}
}