<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsSku extends Model
{
    //表名
    protected $table = 'goods_sku';

    //指定主键
    protected $primaryKey = 'sku_id';


    //不被赋值的字段
    protected $guarded = [];

    //默认添加开始时间create_at字段和结束时间updated_at，默认开启ture
    public $timestamps = false;
}
