<?php
namespace App;
class Cart{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart){
    if ($oldCart){
        $this->items = $oldCart->items;
        $this->totalQty = $oldCart->totalQty;
        $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id) {
        $storedItem = ['qty' => 0, 'product_price' => $item->product_price, 'item' => $item];
        if ($this->items) {
            if (array_key_exists($id, $this->items)){
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']++;
        $storedItem['product_price'] = $item->product_price * $storedItem['qty'];
        $this->items[$id] =$storedItem;
        $this->items[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPrice += $item->product_price;
    }
    public function order(){
        return $this->hasMany('App\Orders');
    }
    public function product(){
        return $this->hasOne('App\Product','id','product_id');
    }
}