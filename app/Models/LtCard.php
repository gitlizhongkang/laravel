<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LtCard extends Model
{
    //表名
    protected $table = 'lt_card';
 

    //默认添加开始时间create_at字段和结束时间updated_at，默认开启ture
    public $timestamps = false;
}
