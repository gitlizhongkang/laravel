<?php

namespace App\Http\Controllers\Home;

use App\Models\Part;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderGoods;
use App\Models\Point;
use App\Models\UserPack;
use App\Models\Pack;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\In;
use Illuminate\Support\Facades\Redis;

class PersonalController extends Controller
{
    /**
     * @brief 首页
     */
    public function index()
    {
        $uid = Session::get('uid');//session内拿用户uid
        //查询用户信息
        $userInfo = $this->getUserInfo($uid);
        $data['userInfo'] = json_decode($userInfo,true);
        //查询地址数量
        $countAddress = $this->getCountAddress($uid);
        $data['countAddress'] = json_decode($countAddress,true);
        //30天内订单数量
        $countOrder = $this->getCountOrder($uid,30);
        $data['countOrder'] = json_decode($countOrder,true);

    	return view('/home/personal/index',$data);
    }

    /**
     * @brief 用户信息
     */
    public function userInfo()
    {
        $uid = Session::get('uid');//session内拿用户uid
        //查询用户信息
        $userInfo = $this->getUserInfo($uid);
        $data['userInfo'] = json_decode($userInfo,true);

        return view('/home/personal/user-info',$data);
    }

    /**
     * @brief 查询用户信息-接口
     * @param string $param
     * @return array|string
     */
    public function getUserInfo($uid='')
    {
        $User = new User();
        if ($uid == '') {
            $uid = Input::get('uid');
        }
        $UserInfos = $User->select('username','tel','email','sex','age','user_point','reg_time')->find($uid)->toArray();

        return json_encode($UserInfos);
    }

    /**
     * @brief 查询省\市\县-接口
     * @param string $param
     * @return array
     */
    public function getDistrict($parent_id = 0){
        $parent_id = Input::get('parent_id')? Input::get('parent_id'):0;
        $District = new District();
        $District = $District->where('parent_id',$parent_id)->get()->toArray();
        if ($District) {
            $data['error'] = 0;
            $data['data'] = $District;
            $data['msg'] = '查询成功';
        } else {
            $data['error'] = 1;
            $data['msg'] = '查询失败';
        }

        return json_encode($data);
    }

    /**
     * @brief 修改用户信息-接口
     * @param array $param
     * @return array|string
     */
    public function updateUserInfo()
    {
        $arr = Input::all();
        unset($arr['_token']);
        $uid = Session::get('uid');//session内拿用户uid
        $User = new User();
        $userInfo = $User->where('user_id',$uid);
        $res = $userInfo->update($arr);
        if ($res == 1){
            $data['error'] = 0;
            $data['msg'] = '修改成功';
        } else {
            $data['error'] = 1;
            $data['msg'] = '修改失败';
        }

        return json_encode($data);
    }

    /**
     * @brief 修改用户密码-接口
     * @param string $param
     * @return array|string
     */
    public function updatePassword()
    {
        $arr = Input::all();
        $uid = Session::get('uid');
        $User = new User();
        $new_password = $arr['new_password'];
        $userInfo = $User->select('password')->find($uid)->toArray();
        if ($arr['old_password'] != $userInfo['password']) {
            $data['error'] = 1;
            $data['msg'] = '原密码输入错误';
        }
        $userInfo = $User->where('user_id',$uid);
        $res = $userInfo->update(['password'=>$new_password]);
        if ($res == 1){
            $data['error'] = 0;
            $data['msg'] = '修改成功';
        } else {
            $data['error'] = 2;
            $data['msg'] = '修改失败';
        }

        return json_encode($data);
    }


    /**
     * @brief 用户订单
     */
    public function userOrder()
    {
        $uid = Session::get('uid');//session内拿用户uid
        //查询订单
        $userOrder = $this->getUserOrder($uid);
        $data['userOrder'] = json_decode($userOrder,true);

        return view('/home/personal/user-order',$data);
    }

    /**
     * @brief 用户订单详细信息
     */
    public function orderDetail()
    {
        $order_id = Input::get('order_id');
        $uid = Session::get('uid');//session内拿用户uid
        //查询订单
        $userOrder = $this->getUserOrder($uid,$order_id);
        $data['userOrder'] = json_decode($userOrder,true);
        //查询订单详情
        $orderGoods = $this->getOrderGoods($order_id);
        $data['orderGoods'] = json_decode($orderGoods,true);

        return view('/home/personal/order-detail',$data);
    }

    /**
     * @brief 用户收货地址
     */
    public function userAddress()
    {
        $uid = Session::get('uid');//session内拿用户uid
        //查询用户收货地址信息
        $userAddress = $this->getUserAddress($uid);
        $userAddress = json_decode($userAddress,true);
        if ($userAddress['error'] == 0) {
            $data['userAddressInfo'] = $userAddress['data'];
        }
        $province = $this->getDistrict();//查询所有省份
        $province = json_decode($province,true);
        if ($province['error'] == 0) {
            $data['province'] = $province['data'];
        }

        return view('/home/personal/user-address',$data);
    }

    /**
     * @brief 查询收货地址-接口
     * @param string $param
     * @return array
     */
    public function getUserAddress($uid='')
    {
        if ($uid == '') {
            $uid = Input::get('uid');
        }
        $UserAddress = new UserAddress();
        $UserAddressInfo = $UserAddress->where('user_id',$uid)->orderBy('is_default','desc')->get()->toArray();
        if ($UserAddressInfo) {
            $data['error'] = 0;
            $data['data'] = $UserAddressInfo;
            $data['msg'] = '查询成功';
        } else {
            $data['error'] = 1;
            $data['msg'] = '查询失败';
        }

        return json_encode($data);
    }

    /**
     * @brief 查询收货地址数量-接口
     */
    public function getCountAddress($uid='')
    {
        if ($uid == '') {
            $uid = Input::get('uid');
        }
        $UserAddress = new UserAddress();
        $countAddress = $UserAddress->where('user_id',$uid)->count();
        $data['error'] = 0;
        $data['data'] = $countAddress;
        $data['msg'] = '查询成功';

        return json_encode($data);
    }


    /**
     * @brief 添加收货地址-接口
     * @param string $param
     * @return array
     */
    public function addUserAddress()
    {
        $arr = Input::all();
        unset($arr['_token']);
        $uid = Session::get('uid');//session内拿用户uid
        $arr['user_id'] = $uid;
        $UserAddress = new UserAddress();
        if ($arr['is_default'] == '1') {
            $UserAddresses = $UserAddress->where(['user_id'=>$uid]);
            $UserAddresses->update(['is_default'=>'0']);
        }
        $res = $UserAddress->fill($arr)->save();
        if ($res) {
            $data['error'] = 0;
            $data['msg'] = '添加成功';
        } else {
            $data['error'] = 1;
            $data['msg'] = '添加失败';
        }
        return json_encode($data) ;
    }

    /**
     * @brief 修改收货地址-接口
     * @param array $param
     * @return array|string
     */
    public function updateUserAddress()
    {
        $arr = Input::all();
        $id = $arr['id'];
        unset($arr['_token']);
        unset($arr['id']);
        $uid = Session::get('uid');//session内拿用户uid
        $UserAddress = new UserAddress();
        if ($arr['is_default'] == '1') {
            $UserAddress = $UserAddress->where(['user_id'=>$uid]);
            $UserAddress->update(['is_default'=>'0']);
        }
        $UserAddress = $UserAddress->where(['id'=>$id,'user_id'=>$uid]);
        $res = $UserAddress->update($arr);
        if ($res == 1){
            $data['error'] = 0;
            $data['msg'] = '修改成功';
        } else {
            $data['error'] = 1;
            $data['msg'] = '修改失败';
        }

        return json_encode($data);
    }

    /**
     * @brief 删除收货地址
     *
     */
    public function deleteUserAddress()
    {
        $id = Input::get('id');
        $userAddress = UserAddress::find($id);
        $res = $userAddress->delete();
        if ($res) {
            $data['error'] = 0;
            $data['msg'] = '删除成功';
        } else {
            $data['error'] = 1;
            $data['msg'] = '删除失败';
        }

        return json_encode($data);
    }

    /**
     * @brief 查询订单-接口
     * @param string $param
     * @return array
     * */
    public function getUserOrder($uid='',$order_id='',$status='')
    {
        $Order = new Order();
        if ($uid==''& $order_id==''& $status==''){
            $uid = Input::get('uid');
            $order_id = Input::get('order_id')?Input::get('order_id'):'';
            $status = Input::get('status')?Input::get('status'):'';
        }
        if($order_id=='' && $status==''){
            //用户订单
            $userOrders = $Order->select('order_id','order_sn','order_time','order_price','status','logistics_number','logistics_type','pay_type')->where(['user_id'=>$uid])->orderBy('order_time','desc')->get()->toArray();
            foreach ($userOrders as $k=>$val) {
                if ($val['status'] == 1 & $val['order_time'] < time()-3600*30) {
                    unset($userOrders[$k]);
                }
            }
        } elseif ($status=='') {
            // 订单详细
            $userOrders = $Order->select('order_id','order_sn','order_time','order_price','status','logistics_type','logistics_price','consignee_tel','consignee_name','consignee_address','pack_price','get_point','pay_type')->where(['user_id'=>$uid,'order_id'=>$order_id])->first()->toArray();
        } else {
            //查询包裹
            $userOrders = $Order->select('order_id','order_sn','order_time','order_price','status','logistics_number','logistics_type','pay_type')->where('status','>=',$status)->where(['user_id'=>$uid])->orderBy('order_time','desc')->get()->toArray();
        }

        return json_encode($userOrders);
    }

    /**
     * @brief 查询订单-接口
     * @param string $param
     * @return array
     * */
    public function getCountOrder($uid='',$time='')
    {
        $Order = new Order();
        if ($uid == '' & $time == '') {
            $uid = Input::get('uid');
            $time = Input::get('time');
        }
        $countOrder = $Order->where("order_time",">","time()-3600*24*$time")->where(['user_id'=>$uid])->count();
        $data['error'] = 0;
        $data['data'] = $countOrder;
        $data['msg'] = '查询成功';

        return json_encode($data);
    }

    /**
    * @brief 查询订单详细-接口
    * @param string $param
    * @return array
    * */
    public function getOrderGoods($order_id='')
    {
        if ($order_id == '') {
            $order_id = Input::all();
        }
        $OrderGoods = new OrderGoods();
        $userOrders = $OrderGoods->select('goods_id','goods_name','sku_norms_value','sku_img','sku_price','num')->where('order_id',$order_id)->get()->toArray();

        return json_encode($userOrders);
    }
    /**
     * @brief 修改订单-接口
     * @param array $param
     * @return array
     * */
    public function updateOrder()
    {
        $arr = Input::all();
        $Order = new Order();
        $order_id = $arr['order_id'];
        unset($arr['order_id']);
        unset($arr['_token']);
        $UserAddress = $Order->where(['order_id'=>$order_id]);
        $res = $UserAddress->update($arr);
        if ($res == 1){
            $data['error'] = 0;
            $data['msg'] = '修改成功';
        } else {
            $data['error'] = 1;
            $data['msg'] = '修改失败';
        }

        return json_encode($data);
    }


    /**
     * @brief 修改订单状态 并 增加积分
     */
    public function updateOrderStatus()
    {
        $order_id = Input::get('order_id');
        $uid = Session::get('uid');//session内拿用户uid
        //查询订单
        $userOrder = $this->getUserOrder($uid,$order_id);
        $userOrder = json_decode($userOrder,true);
            //更改收货状态
            $Order = new Order();
            $order = $Order->where(['order_id'=>$order_id,'user_id'=>$uid])->first();
            $order->status = 4;
            $is_order = $order->save();
        if ($userOrder['pay_type'] != '5') {
            //添加积分
            $User = new User();
            $user = $User->where('user_id',$uid)->first();
            $user->user_point += $userOrder['get_point'];
            $re = $user->save();
            //添加积分日志
            $Point = new Point();
            $Point->user_id = $uid;
            $Point->point = $userOrder['get_point'];
            $Point->content = "完成了订单".$userOrder['order_sn']."，获得了".$userOrder['get_point']."的积分";
            $Point->add_time = time();
            $Point->status = 1;
                $res = $Point->save();
            if ($res == true & $re == true) {
                $data['error'] = 0;
                $data['msg'] = '修改成功！';
            } else {
                $data['error'] = 1;
                $data['msg'] = '修改失败！';
            }
        } else {
            if ($is_order == true) {
                $data['error'] = 0;
                $data['msg'] = '修改成功！';
            } else {
                $data['error'] = 1;
                $data['msg'] = '修改失败！';
            }
        }


        echo json_encode($data);
    }
    /**
     * @brief 取消订单-接口
     * @param string $param
     * @return array
     */
    public function deleteOrder()
    {
        $order_id = Input::get('order_id');
        DB::beginTransaction();
            $Order = Order::find($order_id);
            $Order->delete();
            $OrderGoods = new OrderGoods();
            $OrderGoods->where('order_id',$order_id)->delete();
        DB::commit();
        DB::rollBack();
            $data['error'] = 0;
            $data['msg'] = '取消订单成功';

        return json_encode($data);
    }

    /**
     * @brief 积分
     */
    public function userPoint()
    {
        $uid = Session::get('uid');
        //获取积分
        $userInfo = $this->getUserInfo($uid);
        $userInfo = json_decode($userInfo,true);
        $data['point'] = $userInfo['user_point'];
        //获取积分详细
        $points = $this->getPoint($uid);
        $data['points'] = json_decode($points,true)['data'];

        return view('home.personal.user-point',$data);
    }

    /**
     * @brief 查询积分-接口
     * @param string $param
     * @return array
     */
    public function getPoint($uid='')
    {
        if ($uid == '') {
            $uid = Input::get('uid');
        }
        $point = new Point();
        $points = $point ->where(['user_id'=>$uid])->orderBy('add_time','desc')->get()->toArray();
        $data['error'] = 0;
        $data['data'] = $points;
        $data['msg'] = '查询成功';

        return json_encode($data);
    }

    /**
     * @brief 包裹
     */
    public function trackingPackages()
    {
        $uid = Session::get('uid');//session内拿用户uid
        //查询订单
        $userOrder = $this->getUserOrder($uid,'',3);
        $data['userOrder'] = json_decode($userOrder,true);

        return view('home.personal.tracking-packages',$data);
    }

    /**
     * @brief 包裹
     */
    public function getTracking()
    {
        $logistics_number = Input::get('logistics_number');
        $data['logistics_number'] = $logistics_number;
        $data['logistics_type'] = Input::get('logistics_type');
        /**
         * 快递查询接口
         */
//        Redis::del($logistics_number);
        if (!empty(Redis::get($logistics_number))) {
            $result = unserialize(Redis::get($logistics_number));
        } else {
            $host = "http://jisukdcx.market.alicloudapi.com";
            $path = "/express/query";
            $method = "GET";
            $appcode = "0d9e3bf7621746edafd3823ae2b36e5c";
            $headers = array();
            array_push($headers, "Authorization:APPCODE " . $appcode);
            $querys = "number=$logistics_number&type=auto";
            $bodys = "";
            $url = $host . $path . "?" . $querys;
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_FAILONERROR, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            if (1 == strpos("$" . $host, "https://")) {
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            }
            $result = curl_exec($curl);
            $jsonarr = json_decode($result, true);
            $result = $jsonarr['result'];
            Redis::setex($logistics_number,60*60,serialize($result));
        }
        $data['result'] = $result;

        return view('home.personal.tracking-info',$data);
    }

    /**
     * @brief 红包
     */
    public function userPack()
    {
        if(Input::get('page')) {
            $page = Input::get('page');
        } else {
            $page = 1;
        }
        $uid = Session::get('uid');//session内拿用户uid
        //查询红包
        $userPack = $this->getPack($uid);
        $data['userPack'] = json_decode($userPack,true);

        return view('home.personal.user-pack',$data);
    }

    /**
     * @brief 查询红包-接口
     */
    public function getPack($uid)
    {
        if ($uid == ''){
            $uid = Input::get('uid');//接uid
        }
        $userPack = new UserPack();
        $packs = $userPack->select('*')->where(['user_id'=>$uid])->simplePaginate(2);
        if ($packs) {
            $data['error'] = 0;
            $data['data'] = $packs;
            $data['msg'] = '查询成功';
        } else {
            $data['error'] = 1;
            $data['msg'] = '查询失败';
        }

        return json_encode($packs);
    }

    public function addPack()
    {
        $bonus_sn = Input::get('bonus_sn');
        $pack = new Pack();
        $uid = Session::get('uid');
        $userPack = new UserPack();
        $res = $userPack->select('pack_id')->where(['pack_sn'=>$bonus_sn,'user_id'=>$uid])->first();
        if (empty($res))
        {
            $receive_num = $pack->select('receive_num')->where(['pack_sn'=>$bonus_sn])->get()->toArray();
            if (empty($receive_num)) {
                    $data['error'] = 1;
                    $data['msg'] = '红包序号不存在！';
                } else {
                $arrPack = $pack->select('*')->where(['pack_sn'=>$bonus_sn])->where('late_receive_time','>',time())->where('pack_num','>',$receive_num)->first()->toArray();
                if (empty($arrPack)) {
                    $arr1 = $pack->select('*')->where(['pack_sn'=>$bonus_sn])->where('late_receive_time','>',time())->first()->toArray();
                    if (empty($arr1)) {
                        $arr2 = $pack->select('*')->where(['pack_sn'=>$bonus_sn])->first()->toArray();
                        if (empty($arr2)) {
                            $arr3 = $pack->select('*')->first()->toArray();
                            if (!empty($arr3)) {
                                $data['error'] = 1;
                                $data['msg'] = '红包序号不存在！';
                            }
                        } else {
                            $data['error'] = 2;
                            $data['msg'] = '你来晚了，红包领取领取时间已结束！';
                        }
                    } else {
                        $data['error'] = 3;
                        $data['msg'] = '你来晚了，红包已被领取完！';
                    }
                } else {
                    $userPack->pack_sn = $arrPack['pack_sn'];
                    $userPack->user_id = $uid;
                    $userPack->pack_name = $arrPack['pack_name'];
                    $userPack->pack_price = $arrPack['pack_price'];
                    $userPack->pack_msg = $arrPack['pack_msg'];
                    $userPack->low_use_price = $arrPack['low_use_price'];
                    $userPack->pack_use_time = $arrPack['pack_use_time'];
                    $res = $userPack->save();
                    if ($res) {
                        $data['error'] = 0;
                        $data['msg'] = '添加成功';
                    } else {
                        $data['error'] = 5;
                        $data['msg'] = '添加失败';
                    }
                }
            }
        } else {
            $data['error'] = 4;
            $data['msg'] = '您已领取过该红包';
        }


        return json_encode($data) ;
    }

    /**
     * @param $url 请求网址
     * @param bool $params 请求参数
     * @param int $ispost 请求方式
     * @param int $https https协议
     * @return bool|mixed
     */
    public static function curl($url, $params = false, $ispost = 0, $https = 0)
    {
        $httpInfo = array();
        $ch = curl_init();
        $hurl = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'].'/';
        $header = array("X-CSRF-TOKEN"=>csrf_token());
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
        if ($https) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
        }
        if ($ispost) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_URL, $hurl.$url);
        } else {
            if ($params) {
                if (is_array($params)) {
                    $params = http_build_query($params);
                }
                curl_setopt($ch, CURLOPT_URL, $hurl.$url . '?' . $params);
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }

        $response = curl_exec($ch);

        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        curl_close($ch);
        return $response;
    }
}
