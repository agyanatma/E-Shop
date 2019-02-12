<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = 'wishlists';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $hidden = [
        'created_at', 'updated_at', 'user_id', 'product_id'
    ];

    public function product(){
        return $this->hasOne('App\Product','id','product_id');
    }

    public function buyer(){
        return $this->hasOne('App\User','id','user_id');
    }
}
