<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['id', 'status'];
    protected $hidden = [
        'created_at', 'updated_at', 'user_id', 'product_id'
    ];

    public function product(){
        return $this->hasOne('App\Product','id','product_id');
    }

    public function buyer(){  //USER
        return $this->hasOne('App\User','id','user_id');
    }

}
