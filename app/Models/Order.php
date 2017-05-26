<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $guarded = ['order_id'];
    protected $primaryKey = 'order_id';
    public $timestamps = false;
}
