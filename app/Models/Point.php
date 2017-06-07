<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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