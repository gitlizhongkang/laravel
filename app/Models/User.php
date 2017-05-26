<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    protected $table = 'user';
    protected $guarded = ['user_id'];
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    /**
     *  验证唯一性
     */
    static function check($data)
    {
        $res = DB::table("user")->where($data)->value("user_id");
        return $res;
    }
    /**
     *  验证用户名 密码
     */
    static function loginCheck($username,$pwd)
    {
        $info=array();
        $res=DB::table("user")->where("username",$username)->orWhere("tel",$username)->orWhere("email",$username)->value("username");
        $data=[
            'username'=>$res,
            'password'=>$pwd
        ];
        if($res){
           $_res=self::check($data);
           if($_res){
               $info['code']=1;
               $info['msg']="登录成功";
               $info['id']=$_res;
           }else{
               $info['code']=2;
               $info['msg']='用户名和密码不匹配';
           }
        }else{
            $info['code']=2;
            $info['msg']='用户名不存在';
        }
        return $info;
    }
    /**
     *  添加新用户
     */
    static function add($data)
    {
        $id=DB::table("user")->insertGetId($data);
        return $id;
    }
    /**
     *  修改
     */
    static function edit($where,$value)
    {
        $res=DB::table('user')->where($where)->update($value);

        return $res;
    }

}
