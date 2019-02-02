<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    
    protected $table = 'products';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['id'];
    public function categories(){
        return $this->hasOne('App\Category_product','id','category_id');
    }
    public function images(){
        return $this->hasMany('App\Product_image');
    }
    public function order(){
        return $this->hasMany('App\Orders');
    }
}