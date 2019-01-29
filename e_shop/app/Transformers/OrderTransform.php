<?php

namespace App\Transformers;

use App\Order;
use League\Fractal\TransformerAbstract;

class OrderTransformer extends TransformerAbstract
{
    public function transform(Order $order){
        return [
            'id' =>$order->id,
            'buyer' =>$order->buyer->fullname,
            'order_date' =>$order->order_date,
            'product' =>$order->product->product_name,
            'qty' =>$order->qty,
            'total' =>$order->total,
        ];
    }
}