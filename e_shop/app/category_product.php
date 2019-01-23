<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Category_product extends Model
{
    protected $table = 'category_products';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['id'];
    public function product(){
        return $this->hasMany('App\Product');
    }
    public function images(){
        return $this->hasMany('App\Category_image');
    }
}