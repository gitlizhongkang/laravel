<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pack extends Model
{
    protected $table = 'pack';
    protected $primaryKey = 'pack_id';
    public $timestamps = false;
}
