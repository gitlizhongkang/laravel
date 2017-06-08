<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    protected $table = 'music';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'author', 'content', 'path'
    ];

    /**
     *  查找乐库
     */
    public function findMusic($params='*',$where='')
    {
        if(empty($where)){
            return $this->select($params)->get()->toArray();
        }else{
            return $this->select($params)->where($where)->get()->toArray();
        }
    }

}