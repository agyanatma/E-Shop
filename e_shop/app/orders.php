<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';
    public $primarykey = 'id';
    public $timestamps = true;
    protected $guarded = ['id'];
}
