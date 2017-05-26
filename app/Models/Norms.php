<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Norms extends Model
{
    //表名
    protected $table = 'norms';

    //指定主键
    protected $primaryKey = 'norms_id';

    //可以被赋值属性的“白名单”
    //protected $fillable

    //不被赋值的字段
    protected $guarded = ['norms_id'];

    //隐藏字段
    //protected $hidden = [];

    //默认添加开始时间create_at字段和结束时间updated_at，默认开启ture
    public $timestamps = false;

    //字段可以直接后面跟着carbon类时间操作
    //protected $dates = ['created_at', 'updated_at'];

    //默认给数据库里的一个字段赋值
    //protected $attributes = ['user_limit' => 100,];

    //查询全部数据
    public function findAll()
    {
        return $this->all()->toArray();
    }



}
