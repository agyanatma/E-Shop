<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    protected $table = 'order_details';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $fillable = [
        'order_id','product_id','price','qty'
    ];
    protected $hidden = [
        'created_at', 'updated_at','product_id'
    ];

    public function order(){
        return $this->hasOne('App\Orders','id','order_id');
    }

    public function product(){
        return $this->hasOne('App\Product','id','product_id');
    }

    public function getPriceAttribute($value){
        return 'Rp '.number_format($value, 0);
    }
}
