<?php

namespace App\Http\Controllers\Home;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Home\PersonalController;
use App\Models\GoodsSku;
use App\Models\UserPack;
use App\Models\UserAddress;
use App\Models\Order;
use App\Models\Goods;
use App\Models\User;
use App\Models\Point;
use App\Models\OrderGoods;

use Illuminate\Validation\Rules\In;
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
        $data['type'] = Input::get('type');
        $sku = new GoodsSku();
        $arr = Input::all();
        $uid = Session::get('uid');
        foreach (explode(',',$arr['sku']) as $val) {
            //查询所有购买商品信息
            $data['goods'][] = $sku->where('sku_id',$val)->first()->toArray();
        }
        $data['num'] = explode(',',$arr['num']);
        if ($data['type'] != 'integral') {
            //不是积分购买时查询红包
            $UserPack = new UserPack();            
            $data['package'] = $UserPack->where(['user_id' => $uid, 'status' => '0'])->where('pack_use_time', '>', time())->get()->toArray();
        }
        $userAddress = new UserAddress();
        //查询收货地址
        $data['userAddress'] = $userAddress->select('*')->where(['user_id' => $uid])->get()->toArray();
        $PersonalController = new PersonalController();
        $province = $PersonalController->getDistrict();//查询所有省份
        $province = json_decode($province,true);
        if ($province['error'] == 0) {
            $data['province'] = $province['data'];
        }

        return view('/home/order',$data);
    }

    /**
     * @brief 完成订单
     */
    public function homeOrderFinsh()
    {
        $arr = Input::all();
        $uid = Session::get('uid');
        $type = $arr['type'];
        //生成订单号
        //uid(3)[支付类型][ymd][时间戳4][随机2]
        if (strlen($uid) >= 3)
        {
            $uid = substr($uid, -3);
        }
        else
        {
            $length = 3 - strlen($uid);
            $uid = str_repeat('0', $length) . $uid;
        }
        $order['order_sn'] = $uid.$arr['pay_type'].date("Ymd",time()).substr(time(),-4).rand(10,99);
        $order['user_id'] = $uid;
        $order['consignee_tel'] = $arr['address_tel'];
        $order['consignee_name'] = $arr['address_name'];
        $order['consignee_address'] = $arr['address'];
        $order['order_price'] = $arr['order_price'];
        $order['pay_type'] = $arr['pay_type'];
        $order['order_time'] = time();
        if ($type == 'integral') {
            $order['status'] = 2;
            $order['logistics_price'] = null;
            $order['pack_id'] = null;
            $order['pack_price'] = null;
        } else {
            $order['status'] = 1;
            $order['logistics_price'] = $arr['logistics_price'];
            $order['pack_id'] =isset($arr['pack_id'])?$arr['pack_id']:null;
            $order['pack_price'] = $arr['pack_price'];
        }
        $order['logistics_type'] = $arr['logistics_type'];
        $order['postscript'] = $arr['postscript'];
        $order['get_point'] = $arr['get_point'];
        $sku = new GoodsSku();
        foreach ($arr['sku_id'] as $k =>$val) {
            $num = $sku->select('sku_num','goods_name','sku_norms')->where('sku_id',$val)->first()->toArray();
            //判断sku_num是否足够
            if ($num['sku_num'] < $arr['num'][$k]) {
                $data['error'] = 2;
                $data['data'] = $num;
                return view('/home/order-error',$data);
            }
        }
        if ($type == 'integral') {
            $user = new User();
            $user_point = $user->where(['user_id'=>$uid])->first()->toArray();
            //积分购买时，判断积分
            if ($user_point['user_point'] < $order['order_price']){
                $data['error'] = 3;
                $data['msg'] = '您的积分不足';
                return view('/home/order-error',$data);
            }
        }
        $Order = new Order();
        DB::beginTransaction();
            //添加订单
            $order_id = $Order->insertGetId($order);
            $goods = [];
            foreach ($arr['sku_id'] as $k => $val) {
                $goods[$k]['sku_id'] = $arr['sku_id'][$k];
                $goods[$k]['sku_sn'] = $arr['sku_sn'][$k];
                $goods[$k]['goods_id'] = $arr['goods_id'][$k];
                $goods[$k]['goods_name'] = $arr['goods_name'][$k];
                $goods[$k]['sku_norms_value'] = $arr['sku_norms_value'][$k];
                $goods[$k]['sku_img'] = $arr['sku_img'][$k];
                $goods[$k]['sku_price'] = $arr['sku_price'][$k];
                $goods[$k]['num'] = $arr['num'][$k];
                $goods[$k]['order_id'] = $order_id;
                $goods[$k]['add_time'] = time();
            }
            $OrderGoods = new OrderGoods();
            //添加订单商品
            $OrderGoods->insert($goods);
            if ($arr['type'] == 'cart') {
                //如果是购物车购买清楚购物车
                $key = 'cart'.$uid;
                $arr = unserialize(Redis::get($key));
                foreach ($arr as $k => $v) {
                    $arr[$k]['status'] = 4;
                }
                Redis::set($key,serialize($arr));
            }
            foreach ($goods as $val) {
                //减去sku库存
                $skuInfo = $sku->where('sku_id',$val['sku_id'])->first();
                $skuInfo->sku_num -= $val['num'];
                $skuInfo->save();
                $Goods = new Goods();
                //添加售出商品数量
                $goodsInfo = $Goods->where('goods_id',$val['goods_id'])->first();
                $goodsInfo->goods_sale_num +=  $val['num'];
                $goodsInfo->save();
            }
            if ($type != 'integral ') {
                if ($order['pack_id'] != '') {
                    //不是积分商品且使用了红包，修改红包状态
                    $UserPack = new UserPack();
                    $pack = $UserPack->where('pack_id',$order['pack_id'])->first();
                    $pack->status = '1';
                    $pack->save();
                }
            }
        DB::commit();
        DB::rollBack();
        $data['order_sn'] = $order['order_sn'];
        $data['type'] = $type;

        return redirect()->action('Home\\OrderController@homeFinsh', $data);
    }

    public function homeFinsh()
    {
        $order_sn = Input::get('order_sn');
        $type = Input::get('type');
        $order = new Order();
        $data = $order->select('pay_type','logistics_type','order_price','order_id')->where('order_sn',$order_sn)->first()->toArray();
        if ($type != 'integral') {
            $data['order_sn'] = $order_sn;
            if ($data['pay_type'] == 1) {
                $data['pay_type'] = '支付宝';
            } else if ($data['pay_type'] == 2) {
                $data['pay_type'] = '微信';
            }
            $order_goods = new OrderGoods();
            $data['order_goods'] = $order_goods->select('goods_name','sku_norms_value','num')->where('order_id',$data['order_id'])->get()->toArray();

            return view('/home/order-finsh',$data);
        } else {
            /**
             * @brief 积分支付
             */
            $uid = Session::get('uid');
            //消耗积分
            $User = new User();
            $user = $User->where('user_id',$uid)->first();
            $user->user_point -= $data['order_price'];
            $re = $user->save();
            //添加积分日志
            $Point = new Point();
            $Point->user_id = $uid;
            $Point->point = $data['order_price'];
            $Point->content = "完成了订单".$order_sn."，消耗了".$data['order_price']."的积分";
            $Point->add_time = time();
            $Point->status = 2;
            $res = $Point->save();
            if ($re == true & $res == true) {
                $date['error'] = 0;
                $date['order_sn'] = $order_sn;
                $date['msg'] = '支付成功,请您耐心等待,并多多关注物流信息！';
            } else {
                $date['error'] = 1;
                $date['order_sn'] = $order_sn;
                $date['order_id'] = $data['order_id'];
                $date['msg'] = '支付失败,请重新支付！';
            }

            return view('/home/pay-success',$date);
        }
    }

    /**
     * @brief alipay支付
     */
    public function pay()
    {
        $arr = Input::all();
        $order = new Order();
        $userOrders = $order->where('order_sn',$arr['WIDout_trade_no'])->first()->toArray();
        if ($userOrders['status'] == 1 & $userOrders['order_time'] < time()-3600*30) {
            $data['error'] = 4;
            $data['msg'] = '支付超时';
            return view('/home/order-error',$data);
        }
        $alipay=app('alipay.web');
        $alipay->setOutTradeNo($arr['WIDout_trade_no']);//订单号
        $alipay->setTotalFee($arr['WIDtotal_fee']);//订单价格
        $alipay->setSubject($arr['WIDsubject']);//订单名称
        $alipay->setBody(implode(',',$arr['WIDbody']));
        $alipay->setQrPayMode('6'); //该设置为可选，添加该参数设置，支持二维码支付。
// 跳转到支付页面。
        return redirect()->to($alipay->getPayLink());
    }

// 异步通知支付结果
    public function AliPayNotify(Request $request){
// 验证请求。
        if (!app('alipay.web')->verify()) {
            Log::notice('Alipay notify post data verification fail.', [
                'data' => $request->instance()->getContent()
            ]);
            return 'fail';
        }
// 判断通知类型。
        switch ($request ->input('trade_status','')) {
            case 'TRADE_SUCCESS':
            case 'TRADE_FINISHED':
                // TODO: 支付成功，取得订单号进行其它相关操作。
                Log::debug('Alipay notify post data verification success.', [
                    'out_trade_no' => $request -> input('out_trade_no',''),
                    'trade_no' => $request -> input('trade_no','')
                ]);
                break;
        }
        return 'success';
    }

// 同步通知支付结果
    public function AliPayReturn()
    {
        $arr = Input::all();
        if ($arr['trade_status'] == 'TRADE_SUCCESS' & $arr['seller_id'] == '2088002075883504') {
            $order = new Order();
            $orderInfo = $order->where(['order_sn'=>$arr['out_trade_no']])->first();
            if ($orderInfo->order_price == $arr['total_fee']) {
                //修改支付状态
                $orderInfo->status = 2;
                $res = $orderInfo->save();
                if ($res == true) {
                    $data['error'] = 0;
                    $data['order_sn'] = $arr['out_trade_no'];
                    $data['msg'] = '支付成功,请您耐心等待,并多多关注物流信息';
                }
            }else {
                $data['error'] = 1;
                $data['order_sn'] = $arr['out_trade_no'];
                $data['msg'] = "支付失败,请重新<a src='home-finsh?order_sn=".$arr['out_trade_no']."'>支付</a>";
            }
        } else {
            $data['error'] = 1;
            $data['order_sn'] = $arr['out_trade_no'];
            $data['msg'] = "支付失败,请重新<a src='home-finsh?order_sn=".$arr['out_trade_no']."'>支付</a>";
        }

        return view('/home/pay-success',$data);
    }

    /**
     * @brief 查询评价权限
     * @return json
     */
    public function getOrder(){
        $user_id = Session::get('uid');
        $goods_id = Input::get('goods_id');
        $Order = new Order();
        $orderInfo = $Order->join('order_goods', 'order_goods.order_id', '=', 'order.order_id')->where(['user_id'=>$user_id,'status'=>4,'goods_id'=>$goods_id])->first();
        if (empty($orderInfo)) {
            $data['error'] = 1;
            $data['msg'] = '只有购买过，且收货的用户才能评价';
        } else {
            $data['error'] = 0;
        }

        return json_encode($data);
    }
}