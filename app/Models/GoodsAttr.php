<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsAttr extends Model
{
   //表名
    protected $table = 'goods_attr';

    //默认添加开始时间和结束时间，默认开启ture
    public $timestamps = false;
}
