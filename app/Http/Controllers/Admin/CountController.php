<?php
namespace App\Http\Controllers\Admin;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class CountController extends Controller
{
    
    public function count_sales()
    {
        return view('admin/count_sales');
    }

    /**
    * //统计
    * @brief 方法简介
    * @param $indent（订单数量）
    * @param $money（销售总金额）
    */
    public function count_count()
    {
        $arr=Input::all();
        $indent = DB::table('order')
            ->whereBetween('order_time', [$arr['datek'],$arr['datez']])
            ->get()->count();
        $money  = DB::table('order')
            ->whereBetween('order_time', [$arr['datek'],$arr['datez']])
            ->get()->sum('order_price');
        $data['indent'] = $indent;
        $data['money']  = $money;

        return $data;
    }



}

 


 
//查询订单数
//  select count(*) as a from `order`

 //查询销售总额
//  select sum(order_price) as money from `order`



// select * from order o inner join order_goods g 
//     on o.order_id = g.order_id 
//     inner join goods_sku sku
//     on g.sku_id = sku.sku_id