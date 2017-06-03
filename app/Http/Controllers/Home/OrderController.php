<?php

namespace App\Http\Controllers\Home;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Home\PersonalController;
use App\Models\GoodsSku;
use App\Models\UserPack;
use App\Models\UserAddress;

use Mail;

class OrderController extends Controller
{

    static function send($file,$email,$username,$key,$subject)
    {

        $info=[];
        $flag = Mail::send("$file",['name'=>$username,'key'=>$key],function($message) use($email,$subject){

            $message ->to($email)->subject($subject);
        });
        if($flag==null){
            $info['code']=1;
        }else{
            $info['code']=2;
        }
        return $info;
    }

    /**
     * @brief 确认订单
     */
    public function setOrder()
    {
        $sku_id = Input::get('sku');
        $data['type'] = Input::get('type');
        $data['num'] = Input::get('num');
        $sku = new GoodsSku();
        $data['goods'] = $sku->select('*')->find($sku_id)->toArray();
        $UserPack = new UserPack();
        $uid = Session::get('uid');
        $data['package'] = $UserPack->where(['user_id'=>$uid,'status'=>'0'])->where('pack_use_time','>',time())->get()->toArray();
        $userAddress = new UserAddress();
        $data['userAddress'] = $userAddress->select('*')->get()->toArray();
        $PersonalController = new PersonalController();
        $province = $PersonalController->getDistrict();//查询所有省份
        $province = json_decode($province,true);
        if ($province['error'] == 0) {
            $data['province'] = $province['data'];
        }
//        print_r($data);die;

        return view('/home/order',$data);
    }

    public function homeOrderFinsh()
    {
        $arr = Input::all();
        $uid = Session::get('uid');
      print_r($arr);
//     [userAddress] => 18[pay_type] => 1[logistics_price] => 20.00
//     [sku_id] => 7[sku_sn] => 1705260250020330000[goods_id] => 33
//     [goods_name] => 测试商品[sku_norms_value] => 500ml,低脂[sku_img] => uploads/2017-05-26/59278e371c043.png
//     [sku_price] => 388[num] => 1[pack_id] => 2[postscript] => [address_name] => 王五
//     [address_tel] => 13611094390[province] => 北京[city] => 北京市[district] => 东城区
//     [address] => 北京上地[logistics_type] => 顺丰快递[pack_price] => 25.00[order_price] => 383
        $order['order_sn'] = date("Ymd",time()).$uid.$arr['goods_id'];
        $order['user_id'] = $uid;
        $order['consignee_tel'] = $arr['address_tel'];
        $order['consignee_name'] = $arr['address_name'];
        $order['consignee_address'] = $arr['address'];
        $order['order_price'] = $arr['order_price'];
        $order['order_time'] = time();
        $order['status'] = 1;
        $order['logistics_type'] = $arr['logistics_type'];
        $order['logistics_price'] = $arr['logistics_price'];
        $order['pack_id'] = $arr['pack_id'];
        $order['pack_price'] = $arr['pack_price'];

    }
}