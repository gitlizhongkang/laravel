<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Part extends  Model
{
    protected $table = 'part';
    //因为他自动带添加时间，这个false是取消时间的，用于添加时候
    public $timestamps = false;
    protected $fillable = ['code', 'name'];

    public function select()
    {
        return $this->get();
    }
    
}
    