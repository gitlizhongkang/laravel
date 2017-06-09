<?php

namespace App\Models;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    //不被赋值字段
    protected $guarded = [];


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
