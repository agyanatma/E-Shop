<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Orders extends Model
{
    protected $table = 'orders';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['id', 'status'];
    protected $fillable = [
        'user_id','email','fullname','address','city','postal_code','order_date','total','status'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function buyer(){
        return $this->hasOne('App\User','id','user_id');
    }

    public function orderDetail(){
        return $this->hasMany('App\Order_detail','order_id','id');
    }
}