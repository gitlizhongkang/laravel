<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use Illuminate\Support\Facades\DB;

class Point extends Model
{
	protected $table = 'point';
    protected $guarded = ['id'];
    protected $primaryKey = 'user_id';

    public $timestamps = false;
  	
  	/**
  	 *  增加积分记录接口
  	 */
  	public function addPoint($data)
  	{
  		 $id=DB::table($this->table)->insertGetId($data);
  		 return $id;
  	}

}
=======

class Point extends Model
{
    protected $table = 'point';
    public $timestamps = false;
}
>>>>>>> 4db62ff51a08a48c9047b4ea7465d9155c8273e1
