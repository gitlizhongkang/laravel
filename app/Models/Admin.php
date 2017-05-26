<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends  Model
{
    protected $table = 'admin';
    //因为他自动带添加时间，这个false是取消时间的，用于添加时候
    public $timestamps = false;
    protected $fillable = ['admin_name', 'create_time', 'last_ip', 'last_time'];
    //隐藏的
    protected $hidden = ['pwd'];


    public function select()
    {
        return $this->get();
    }

}
    