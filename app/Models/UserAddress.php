<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $table = 'user_address';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    public $timestamps = false;
}
