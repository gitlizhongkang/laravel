<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //表名
    protected $table = 'goods';

    //不被赋值字段
    protected $guarded = [];

    //指定主键
    protected $primaryKey = 'goods_id';


    //默认添加开始时间create_at字段和结束时间updated_at，默认开启ture
    public $timestamps = false;

    /**
     * @brief 添加
     * @param $data
     * @return bool
     */
    public function add($data)
    {
        $this->fill($data);         //期望接受[[1,2,3],[aa,bb,cc]]
        return $this->save();
    }
    //DB::table('goods_attr')->insert($dataAttributes);
    //期望接受[[1,aa],[2,bb],[3,cc]]


}
