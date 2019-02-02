<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_image extends Model
{
    protected $table = 'user_images';
    public $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = ['id'];
    protected $hidden = [
        'created_at', 'updated_at', 'user_id'
    ];

    public function user(){
        return $this->hasOne('App\User');
    }
}
