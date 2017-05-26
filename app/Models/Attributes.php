<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attributes extends Model
{
    //表名
    protected $table = 'attributes';

    //指定主键
    protected $primaryKey = 'attr_id';

    //默认添加开始时间create_at字段和结束时间updated_at，默认开启ture
    public $timestamps = false;


    /**
     * @brief 根据分类id查询属性数据根据分类id查询属性数据
     * @param $categoryId
     * @return mixed
     */
    public function findByCategoryId($categoryId)
    {
        return $this->where('category_id', $categoryId)->get()->toArray();
    }


}
