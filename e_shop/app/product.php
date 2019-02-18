<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    
    protected $table = 'products';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $hidden = [
        'created_at', 'updated_at', 'category_id'
    ];

    public function categories(){
        return $this->hasOne('App\Category_product','id','category_id');
    }

    public function images(){
        return $this->hasMany('App\Product_image');
    }

    public function image(){
        return $this->hasOne('App\Product_image');
    }

    public function orderDetail(){
        return $this->hasOne('App\Order_detail');
    }

    public function orderProduct(){
        return $this->hasMany('App\Order_product','product_id','id');
    }
}