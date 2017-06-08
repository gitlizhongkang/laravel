<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redis;


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
		$start_time = isset(Input::get()['start_time'])?Input::get()['start_time']:'';
		$end_time = isset(Input::get()['end_time'])?Input::get()['end_time']:'';
		$goods_name = isset(Input::get()['goods_name'])?Input::get()['goods_name']:'';

		if ($start_time == '' || $end_time == '') {
			$msg['error'] = 1000;
			$msg['message'] = '请输入查询范围';
		}
		if ($goods_name == '') {
			$msg['error'] = 1000;
			$msg['message'] = '请输入商品名称或货号';
		} 		
	}
}