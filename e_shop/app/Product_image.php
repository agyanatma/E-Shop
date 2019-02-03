<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Product_image extends Model
{
    protected $table = 'product_images';
    public $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = ['id'];
    protected $hidden = [
        'created_at', 'updated_at', 'product_id'
    ];

    public function product(){
        return $this->hasOne('App\Product');
    }
}