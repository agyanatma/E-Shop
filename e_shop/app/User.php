<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    protected $table = 'users';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $guarded = ['id'];
    public function order(){
        return $this->hasMany('App\Orders');
    }
}