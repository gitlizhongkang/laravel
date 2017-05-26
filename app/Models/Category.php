<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //表名
    protected $table = 'category';

    //指定主键
    protected $primaryKey = 'category_id';

    //默认添加开始时间create_at字段和结束时间updated_at，默认开启ture
    public $timestamps = false;


    /**
     * @brief 查询一级分类数据
     * @return mixed
     */
    public function findTopCategory()
    {
        return $this->where('parent_id', 0)->get()->toArray();
    }


    /**
     * @brief 查询所有分类
     * @return mixed
     */
    public function findAll()
    {
        return $this->all()->toArray();
    }


    /**
     * @brief 层级分类
     * @param $data
     * @param int $parent_id
     * @param int $leave
     * @return array
     */
    public function tree($data, $parent_id = 0, $leave = 0)
    {
        static $tree;
        foreach($data as $key=>$val)
        {
            if($val['parent_id'] == $parent_id)
            {
                $val['category_name'] = str_repeat('-', $leave) . $val['category_name'];
                $tree[] = $val;
                $this->tree($data,$val['category_id'],$leave + 1);
            }
        }
        return $tree;
    }



}
