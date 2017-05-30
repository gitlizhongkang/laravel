<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderGoods;
use App\Models\Point;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\In;

class PersonalController extends Controller
{
    /**
     * @brief 首页
     */
    public function index()
    {
        $uid = Session::get('uid');//session内拿用户uid
        //查询用户信息
        $userInfo = $this->curl('home-personal-getUserInfo', "uid=$uid", true);
        $data['userInfo'] = json_decode($userInfo,true);
        //查询地址数量
        $countAddress = $this->curl('home-personal-getCountAddress', "uid=$uid", true);
        $data['countAddress'] = json_decode($countAddress,true);
        //30天内订单数量
        $countOrder = $this->curl('home-personal-getCountOrder', ['uid'=>$uid,'time'=>30], true);
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
        $userInfo = $this->curl('home-personal-getUserInfo', "uid=$uid", true);
        $data['userInfo'] = json_decode($userInfo,true);

        return view('/home/personal/user-info',$data);
    }

    /**
     * @brief 查询用户信息-接口
     * @param string $param
     * @return array|string
     */
    public function getUserInfo()
    {
        $User = new User();
        $uid = Input::get('uid');
        $UserInfos = $User->select('username','tel','email','sex','age','user_point','reg_time')->find($uid)->toArray();

        return json_encode($UserInfos);
    }

    /**
     * @brief 查询省\市\县-接口
     * @param string $param
     * @return array
     */
    public function getDistrict($parent_id = 0){
        if ($arr=Input::all()) {
            $parent_id = $arr['parent_id'];
        }
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
        $userOrder = $this->curl('home-personal-getUserOrder', "uid=$uid", true);
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
        $userOrder = $this->curl('home-personal-getUserOrder', "order_id=$order_id&uid=$uid", true);
        $data['userOrder'] = json_decode($userOrder,true);
        //查询订单详情
        $orderGoods = $this->curl('home-personal-getOrderGoods', "order_id=".$order_id, true);
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
        $userAddress = $this->curl('home-personal-getUserAddress', "uid=$uid", true);
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
    public function getUserAddress()
    {
        $uid = Input::get('uid');
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
    public function getCountAddress()
    {
        $uid = Input::get('uid');
        $UserAddress = new UserAddress();
        $countAddress = $UserAddress->where('user_id',$uid)->count();
        if ($countAddress) {
            $data['error'] = 0;
            $data['data'] = $countAddress;
            $data['msg'] = '查询成功';
        } else {
            $data['error'] = 1;
            $data['msg'] = '查询失败';
        }

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
    public function getUserOrder(){
        $Order = new Order();
        $uid = Input::get('uid');
        $order_id = Input::get('order_id')?Input::get('order_id'):'';
        if(!$order_id){
            $userOrders = $Order->select('order_id','order_sn','order_time','order_price','status')->where(['user_id'=>$uid])->orderBy('order_time','desc')->get()->toArray();
        } else {
            $userOrders = $Order->select('order_id','order_sn','order_time','order_price','status','logistics_type','logistics_price','consignee_tel','consignee_name','consignee_address')->where(['user_id'=>$uid,'order_id'=>$order_id])->first()->toArray();
        }

        return json_encode($userOrders);
    }

    /**
     * @brief 查询订单-接口
     * @param string $param
     * @return array
     * */
    public function getCountOrder(){
        $Order = new Order();
        $uid = Input::get('uid');
        $time = Input::get('time');
        $countOrder = $Order->where("order_time",">","time()-3600*24*$time")->where(['user_id'=>$uid])->count();
        if ($countOrder) {
            $data['error'] = 0;
            $data['data'] = $countOrder;
            $data['msg'] = '查询成功';
        } else {
            $data['error'] = 1;
            $data['msg'] = '查询失败';
        }

        return json_encode($data);
    }

    /**
    * @brief 查询订单详细-接口
    * @param string $param
    * @return array
    * */
    public function getOrderGoods(){
        $order_id = Input::all();
        $OrderGoods = new OrderGoods();
        $userOrders = $OrderGoods->select('goods_id','goods_name','sku_norms_value','sku_price','num')->where('order_id',$order_id)->get()->toArray();

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

    public function userPoint()
    {
        $uid = Session::get('uid');
        //获取积分
        $userInfo = $this->curl('home-personal-getUserInfo', "uid=$uid", true);
        $userInfo = json_decode($userInfo,true);
        $data['point'] = $userInfo['user_point'];
        //获取积分详细
        $points = $this->curl('home-personal-getPoint', "uid=$uid", true);
        $data['points'] = json_decode($points,true)['data'];

        return view('home.personal.user-point',$data);
    }

    public function getPoint()
    {
        $uid = Input::get('uid');
        $point = new Point();
        $points = $point ->where(['user_id'=>$uid])->get()->toArray();
        if ($points) {
            $data['error'] = 0;
            $data['data'] = $points;
            $data['msg'] = '查询成功';
        } else {
            $data['error'] = 1;
            $data['msg'] = '查询失败';
        }

        return json_encode($data);
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
