<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsSecond extends Model
{
    protected $table = 'goods_second';

    //指定主键
    protected $primaryKey = 'goods_id';

    //不被赋值的字段
    protected $guarded = [];

    //默认添加开始时间和结束时间，默认开启ture
    public $timestamps = false;

    /**
     * @brief 添加
     * @param $data
     * @return bool
     */
    public function add($data)
    {
        $this->fill($data);         //期望接受[[k1,k2,k3],[v1,v2,v3]]
        return $this->save();
    }
}
