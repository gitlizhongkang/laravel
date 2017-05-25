<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsSecond extends Model
{
    protected $table = 'goods_second';

    //默认添加开始时间和结束时间，默认开启ture
    public $timestamps = false;
}
