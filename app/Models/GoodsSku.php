<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsSku extends Model
{
    //表名
    protected $table = 'goods_sku';

    //指定主键
    protected $primaryKey = 'sku_id';
}
