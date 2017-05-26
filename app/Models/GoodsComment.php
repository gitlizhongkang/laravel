<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsComment extends Model
{
    //表名
    protected $table = 'goods_comment';

    //指定主键
    protected $primaryKey = 'comment_id';

    //默认添加开始时间和结束时间，默认开启ture
    public $timestamps = false;
}
