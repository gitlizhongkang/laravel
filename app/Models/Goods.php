<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //表名
    protected $table = 'goods';

    //指定主键
    protected $primaryKey = 'goods_id';
}
