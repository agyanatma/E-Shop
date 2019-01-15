<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_image extends Model
{
    protected $table = 'product_images';
    public $primarykey = 'id';
    public $timestamps = false;
    protected $guarded = ['id'];
}
