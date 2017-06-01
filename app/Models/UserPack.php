<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPack extends Model
{
    protected $table = 'user_pack';
    protected $primaryKey = 'pack_id';
    public $timestamps = false;
}
