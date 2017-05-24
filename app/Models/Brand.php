<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //表名
    protected $table = 'brand';

    //指定主键
    protected $primaryKey = 'brand_id';

    //默认添加开始时间create_at字段和结束时间updated_at，默认开启ture
    public $timestamps = false;


    /**
     * @brief 查询品牌
     * @return mixed
     */
    public function findAll()
    {
        return $this->all()->toArray();
    }
}
