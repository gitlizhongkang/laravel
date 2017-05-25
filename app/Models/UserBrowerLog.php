<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBrowerLog extends Model
{
    protected $table = 'user_brower_log';

    //默认添加开始时间和结束时间，默认开启ture
    public $timestamps = false;
}
