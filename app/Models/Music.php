<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
    static function findMusic($params='*',$where="[1=>1]")
    {
        return DB::table('music')->select($params)->where($where)->get();
    }

}