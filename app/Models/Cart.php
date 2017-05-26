<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //表名
    protected $table = 'cart';

    //指定主键
    protected $primaryKey = 'cart_id';
   
    //设置黑名单
    protected  $guarded=[];

    //默认添加开始时间和结束时间，默认开启ture
    public $timestamps = false;
}
