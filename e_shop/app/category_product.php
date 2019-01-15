<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category_product extends Model
{
    protected $table = 'category_products';
    public $primarykey = 'id';
    public $timestamps = true;
    protected $guarded = ['id'];
}
