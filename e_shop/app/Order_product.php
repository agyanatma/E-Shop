<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_product extends Model
{
    protected $table = 'order_products';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $fillable = [
        'user_id','product_id','price','qty','total'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function product(){
        return $this->belongsToMany('App\Product');
    }

    public function buyer(){
        return $this->hasOne('App\User');
    }
}
