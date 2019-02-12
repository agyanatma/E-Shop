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
        'password', 'remember_token','created_at', 'updated_at', 'admin'
    ];
    protected $guarded = ['id'];

    protected $fillable = [
        'email', 'password', 'fullname', 'address', 'city', 'postal_code', 'api_token'
    ];

    public function order(){
        return $this->hasMany('App\Orders');
    }

    public function getProfileImageAttribute($value){
        return '/upload/'.$value;
    }

    public function getFullnameAttribute($value){
        return ucfirst($value);
    }
}
