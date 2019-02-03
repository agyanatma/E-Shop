<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category_image extends Model
{
    protected $table = 'category_images';
    public $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = ['id'];
    protected $hidden = [
        'created_at', 'updated_at', 'category_id'
    ];

    public function categories(){
        return $this->belongsTo('App\Category_product');
    }
}
