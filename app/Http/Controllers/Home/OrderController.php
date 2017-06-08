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
        foreach (explode(',',$arr['sku']) as $val) {
            $data['goods'][] = $sku->where('sku_id',$val)->first()->toArray();
        }
        $data['num'] = explode(',',$arr['num']);
        if ($data['type'] != 'integral') {
            $UserPack = new UserPack();
            $uid = Session::get('uid');
            $data['package'] = $UserPack->where(['user_id' => $uid, 'status' => '0'])->where('pack_use_time', '>', time())->get()->toArray();
        }
        $userAddress = new UserAddress();
        $data['userAddress'] = $userAddress->select('*')->get()->toArray();
        $PersonalController = new PersonalController();
        $province = $PersonalController->getDistrict();//查询所有省份
        $province = json_decode($province,true);
        if ($province['error'] == 0) {
            $data['province'] = $province['data'];
        }

        return view('/home/order',$data);
    }

    public function homeOrderFinsh()
    {
        $arr = Input::all();
        $uid = Session::get('uid');
        $type = $arr['type'];
        $order['order_sn'] = date("YmdHis",time()).$uid.$arr['pay_type'];
        $order['user_id'] = $uid;
        $order['consignee_tel'] = $arr['address_tel'];
        $order['consignee_name'] = $arr['address_name'];
        $order['consignee_address'] = $arr['address'];
        $order['order_price'] = $arr['order_price'];
        $order['pay_type'] = $arr['pay_type'];
        $order['order_time'] = time();
        if ($type == 'integral') {
            $order['status'] = 2;
            $order['is_point'] = 1;
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
            if ($num['sku_num'] < $arr['num'][$k]) {
                $data['error'] = 2;
                $data['data'] = $num;
                return view('/home/order-error',$data);
            }
        }
        if ($type == 'integral') {
            $user = new User();
            $user_point = $user->where(['user_id'=>$uid])->first()->toArray();
            if ($user_point['user_point'] < $order['order_price']){
                $data['error'] = 3;
                $data['msg'] = '您的积分不足';
                return view('/home/order-error',$data);
            }
        }
        $Order = new Order();
        DB::beginTransaction();
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
            }
            $OrderGoods = new OrderGoods();
            $OrderGoods->insert($goods);
            if ($arr['type'] == 'cart') {
                $key = 'cart'.$uid;
                $arr = unserialize(Redis::get($key));
                foreach ($arr as $k => $v) {
                    $arr[$k]['status'] = 4;
                }
                Redis::set($key,serialize($arr));
            }
            foreach ($goods as $val) {
                $goodsInfo = $sku->where('sku_id',$val['sku_id'])->first();
                $goodsInfo->sku_num -= $val['num'];
                $goodsInfo->save();
            }
            if ($type != 'integral ') {
                if ($order['pack_id'] != '') {
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
            $Point->content = "完成了订单$order_sn，消耗了".$data['order_price']."的积分";
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

    public function pay()
    {
        $arr = Input::all();
        $alipay=app('alipay.web');

        $alipay->setOutTradeNo($arr['WIDout_trade_no']);//订单号
        $alipay->setTotalFee($arr['WIDtotal_fee']);//订单价格
        $alipay->setSubject($arr['WIDsubject']);//订单名称
        $alipay->setBody(implode(',',$arr['WIDbody']));
        $alipay->setQrPayMode('6'); //该设置为可选，添加该参数设置，支持二维码支付。
// 跳转到支付页面。
        return redirect()->to($alipay->getPayLink());
//        $path = substr($_SERVER['SCRIPT_FILENAME'],0,strpos($_SERVER['SCRIPT_FILENAME'],'/public'));
//        $alipay_config = include($path."/config/alipay.php");
//        require_once($path."/app/libs/lib/AlipaySubmit.php");
//        /**************************请求参数**************************/
//        //商户订单号，商户网站订单系统中唯一订单号，必填
//        $out_trade_no = $_POST['WIDout_trade_no'];
//
//        //订单名称，必填
//        $subject = $_POST['WIDsubject'];
//
//        //付款金额，必填
//        $total_fee = $_POST['WIDtotal_fee'];
//
//        //商品描述，可空
//        $body = $_POST['WIDbody'];
//
//        /************************************************************/
//
////构造要请求的参数数组，无需改动
//        $parameter = array(
//            "service"       => $alipay_config['service'],
//            "partner"       => $alipay_config['partner'],
//            "seller_id"  => $alipay_config['seller_id'],
//            "payment_type"	=> $alipay_config['payment_type'],
//            "notify_url"	=> $alipay_config['notify_url'],
//            "return_url"	=> $alipay_config['return_url'],
//
//            "anti_phishing_key"=>$alipay_config['anti_phishing_key'],
//            "exter_invoke_ip"=>$alipay_config['exter_invoke_ip'],
//            "out_trade_no"	=> $out_trade_no,
//            "subject"	=> $subject,
//            "total_fee"	=> $total_fee,
//            "body"	=> $body,
//            "_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
//        );
//
////建立请求
//        $alipaySubmit = new AlipaySubmit($alipay_config);
//        $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
//        echo $html_text;
//
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

    public function AliPayReturn()
    {
        $arr = Input::all();
        if ($arr['trade_status'] == 'TRADE_SUCCESS' & $arr['seller_id'] == '2088002075883504') {
            $order = new Order();
            $orderInfo = $order->where(['order_sn'=>$arr['out_trade_no']])->first();
            if ($orderInfo->order_price == $arr['total_fee']) {
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

}