<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsComment extends Model
{
    //表名
    protected $table = 'goods_comment';

    //指定主键
    protected $primaryKey = 'comment_id';
}
