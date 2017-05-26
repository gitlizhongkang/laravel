<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //表名
    protected $table = 'category';

    //指定主键
    protected $primaryKey = 'category_id';

    //默认添加开始时间和结束时间，默认开启ture
    public $timestamps = false;
}
