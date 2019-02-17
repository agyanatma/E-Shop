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
        'created_at', 'updated_at'
    ];

    public function order(){
        return $this->belongsTo('App\Orders');
    }

    public function product(){
        return $this->hasMany('App\Product');
    }
}
