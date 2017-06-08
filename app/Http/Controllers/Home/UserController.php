<?php

namespace App\Http\Controllers\Home;

use common\models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\OrderController as Email;
use Illuminate\Http\Response;
use Session;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use App\Models\Point;


class UserController extends Controller

{
    /**
     * 用户注册
     */
    public function register()
    {
            return view("home/register");
    }
    /**
     *  用户提交注册接口
     */
    public function commitApi($info)
    {
        $data['code']=2;
        $id=User::add($info);
           if($id){
              $data['code']=1;
              $data['msg']=$id;
           }
        return json_encode($data);
    }
    /**
     *  用户提交注册
     */
    public function commit()
    {
        $type=Input::get("type")?Input::get("type"):'';
        if($type=="bind-register"){
            if( Session::get("weiboUid")=='' ){
                return redirect("home-user-login");
            }
        }
        $info['username']= Input::get("username");
        $info['email']= Input::get("email");
        $info['tel']= Input::get("tel");
        $info['password']= md5(Input::get("password"));
        $info['reg_time']=time();
        $info['user_point']=100;
        $res=$this->commitApi($info);
        $res=json_decode($res,true);
        if($res['code']==1){
            if($type=="bind-register"){
                Session::forget("weiboUid");
                Session::forget("weiboUname");
            }
            Session::forget($info['tel']);
            Session::forget("authCode");
            Session::put("uid",$res['msg']);
            Session::put("username",$info['username']);
            // 增加积分记录
            $pointInfo['user_id']=$res['msg'];
            $pointInfo['point']=100;
            $pointInfo['content']="注册成功，送100积分";
            $pointInfo['status']=1;
            $pointInfo['add_time']=time();
            $point=new Point();
            $point->addPoint($pointInfo);
            return redirect()->action("Home\\IndexController@index");
        }
    }
    /**
     *  验证用户名，手机号，邮箱 唯一性
     * @return json
     */
    public function uniqueCheck()
    {
        $type=Input::get('type');
        $value=Input::get('value');
        $data[$type]=$value;
        $res=User::check($data,'user_id');
       if(empty($res)){
           $data['code']=1;
       }else{
           $data['code']=2;
       }
        echo json_encode($data);
    }
    /**
     * 
     */

    /**
     *  判断验证码是否正确
     * @return json
     */
    public function codeCheck()
    {
        $code=Input::get("code");
        $authCode=Session::get("authCode");
        if($code==$authCode){
            $data['code']=1;
        }else{
            $data['code']=2;
        }
        echo json_encode($data);
    }
    /**
     *  发送验证码
     *  @return json
     */
    public function send()
    {
            $tel=Input::get("tel");
            if(Session::get($tel)){
                $data['code']=2;
                $data['msg']="您已发送过验证码请耐心等待";
            }else{
                $res= $this->make();
                Session::put($tel,$res);
                $data['code']=1;
                $data['msg']="短信发送成功";
            }
            
            echo json_encode($data);
    }
    /**
     *  判断手机验证码
     *  @return json
     */
    public function mobileCheck()
    {
        $tel=Input::get("tel");
        $mobileCode=Input::get("mobileCode");
        $str=Session::get($tel)?Session::get($tel):'';
        if($str == $mobileCode){
             $data['code']=1;
        }else{
            $data['code']=2;
            $data['msg']="验证码无效或过期,请重新获取";
        }
        echo json_encode($data);
    }

    /**
     * 登录页面
     * 
     */
    public function login()
    {
        return view("home/login");
    }
    /**
     * 登录验证
     */
    public function loginCheck()
    {
        $username=$this->filter(Input::get("username"));
        $password=$this->filter(Input::get("password"));
        $remember=Input::get("remember");
        $type=Input::get("type")?Input::get("type"):'';
        if($type){
            if(Session::get("weiboUid")==''){
                $res['msg']="验证无效请重新授权";
            }
        }
        $res=User::loginCheck($username,$password);
        if($res['code']==1){
            if($type=='bind-login'){
                $where['user_id']=$res['id'];
                $info['sina_id']=Input::get("weiboId");
                $result=User::edit($where,$info);
                if($result){
                    $res['msg']="绑定成功";
                    Session::put("uid",$res['id']);
                    Session::put("username",$res['username']);
                    Session::forget("weiboUid");
                    Session::forget("weiboUname");
                }else{
                    $res['code']=2;
                    $res['msg']="绑定失败";
                }
            }else{
                Session::put("uid",$res['id']);
                Session::put("username",$res['username']);
            }
        }
        echo json_encode($res);
    }
    /**
     *  忘记密码 page
     */
    public function forgetPassword()
    {

        return view("home/forget-password");
    }
    /**
     *  验证用户 发送邮箱
     */
    public function getPassword()
    {
        $username=$this->filter(Input::get("user_name"));
        $email=$this->filter(Input::get("email"));
        if(Session::get("authEmail")==$email){
            $info['msg']="请勿重复发送";
        }else{
            $data['username']=$username;
            $res=User::check($data,"user_id");
            if($res){
                $data['email']=$email;
                $_res=User::check($data,"user_id");
                if($_res){
                    Session::put("authEmail",$email);
                    $subject="账户密码找回邮件";
                    $key=md5(time().$_res);
                    Session::put($key,$_res);
                    $result=Email::send('emails/orders',$email,$username,$key,$subject);
                    if($result['code']==1){
                        $info['code']=1;
                    }else{
                        $info['msg']="邮件发送失败";
                    }
                }else{
                    $info['msg']="用户名和邮箱不匹配";
                }
            }else{
                $info['msg']='用户名不存在';
            }
        }
        echo json_encode($info);
    }

    /**
     *  重置密码 page
     */
    public function findPassword()
    {
        $key=Input::get("key");
        $info=$this->findApi($key);
        $data=json_decode($info,true);
        if($data['code']==1){
            Session::forget("authEmail");
            return view('home/reset-password',["id"=>$data['msg'],"key"=>$key]);
        }else{
            return redirect()->action('Home\UserController@forgetPassword');
        }
    }
    /**
     *  重置密码 page 接口
     */
    public function findApi($key)
    {
        $id= Session::get($key)?Session::get($key):'';
        if($id==''){
            $info['msg']="邮件已失效请重新发送";
            $info['code']=2;
        }else{
            $info['code']=1;
            $info['msg']=$id;
        }
        return  json_encode($info);
    }
    /**
     *  reset password
     */
    public function resetPassword()
    {
        $where['user_id']=Input::get("user_id");
        $data['password']=Input::get("new_password");
        $key=Input::get("key");
        if(Session::get($key)==''){
           $info['msg']="验证失效重新发送";
        }else{
            $res=User::edit($where,$data);
            if($res){
                Session::forget($key);
                $info['code']=1;
                $info['msg']='修改成功';
            }else{
                $info['code']=2;
                $info['msg']="修改失败";
            }
        }
        echo json_encode($info);

    }
    /**
     *   回调域
     */
    public function bind()
    {
        $code=Input::get("code")?Input::get("code"):'';
        $data = config('weibo');
        $url=$data['auth_uri'];
        $data['code']=$code;
        $res=$this->curl($url,$data,true,true);
        $res=json_decode($res,true);
        if(isset($res['access_token'])){
            $val['access_token']=$res['access_token'];
            $val['uid']=$res['uid'];
            $uid=$res['uid'];
            $info['sina_id']=$uid;
            $_res=User::check($info,"user_id");
            if($_res){
                $where['user_id']=$_res;
                $username=User::check($where,"username");
                Session::put("uid",$_res);
                Session::put("username",$username);
                return redirect()->action("Home\\IndexController@index");
            }else{
                $showUrl=$data['show_uri'];
                $userInfo=$this->curl($showUrl,$val,false,true);
                $userInfo=json_decode($userInfo,true);
                Session::put("weiboUid",$uid);
                Session::put("weiboUname",$userInfo['name']);
                return redirect()->action("Home\\UserController@babyBind");
            }
        }else{
            return redirect("home-user-login");
        }
    }
    /**
     *  绑定页面
     */
    public function babyBind()
    {
        $uid=Session::get("weiboUid");
        $uname=Session::get("weiboUname");
        if($uid && $uname){
            return view("home/bind",['uid'=>$uid,'uname'=>$uname]);
        }else{
            return redirect("home-user-login");
        }

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
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($https) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
        }
        if ($ispost) {
            $postfields = '';
            foreach ($params as $key => $value){
                $postfields .= urlencode($key) . '=' . urlencode($value) . '&';
            }
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
            curl_setopt($ch, CURLOPT_URL, $url);
        } else {
            if ($params) {
                if (is_array($params)) {
                    $params = http_build_query($params);
                }
                curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
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
    /**
     *  过滤数据方法
     * @param 传过来的数据
     * @return 过滤后的数据
     */
    public function filter($data)
    {
        if(is_string($data)){
            $data = trim($data);  //清理空格
            $data = htmlspecialchars($data);   //将字符内容转化为html实体
            $data = addslashes($data);   //使用反斜线引用字符串
        }else if (is_int($data)) {
            $data = intval($data);   //获取变量的整数值
        } elseif (is_float($data)) {
            $data = floatval($data);  //获取变量的浮点值
        }
        return $data;
    }
    /**
     * 生成随机数
     */
    public function make()
    {
        $count = 0;
        $return = array();
        while ($count < 4)
        {
            $return[] = mt_rand(1, 9);
            $return = array_flip(array_flip($return));
            $count = count($return);
        }
        $num='';
        foreach ($return as $key => $value) {
            $num.=$return[$key];
        }
        return $num;
    }
    /**
     * 生成验证码
     */
    public function code()
    {
        $image=imagecreatetruecolor(100, 30);
        $bgcolor=imagecolorallocate($image,255,255,255);
        imagefill($image,0,0,$bgcolor);
        $captch_code='';
        for($i=0;$i<4;$i++){
            $fontsize=20;
            $fontcolor=imagecolorallocate($image,rand(0,120),rand(0,120),rand(0,120));
            $data='abcdefghijklmnpqrstuvwxyz123456789';
            $fontcontent=substr($data,rand(0,strlen($data)),1);
            $captch_code.=$fontcontent;
            Session::put("authCode",$captch_code);
            $x=($i*100/4)+rand(5,10);
            $y=rand(5,10);
            imagestring($image, $fontsize, $x, $y, $fontcontent, $fontcolor);
        }
        //加点干扰
        for($i=0;$i<200;$i++){
            $pointcolor=imagecolorallocate($image,rand(50,200),rand(50,200),rand(50,200));
            imagesetpixel($image, rand(1,99), rand(1,99), $pointcolor);
        }
        //加线干扰
        for($i=0;$i<3;$i++){
            $linecolor=imagecolorallocate($image,rand(80,220),rand(80,220),rand(80,220));
            imageline($image, rand(1,99), rand(1,29), rand(1,99),rand(1,29),$linecolor);
        }
        header('content-type:image/png');
        imagepng($image);
    }
}

