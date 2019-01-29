<?php

namespace App\Transformers;

use App\Orders;
use League\Fractal\TransformerAbstract;

class OrderTransformer extends TransformerAbstract
{   
    public function transform(Orders $orders){
        return [
            'id' =>$orders->id,
            'buyer' =>[
                'id' =>$orders->buyer->id,
                'name' =>$orders->buyer->fullname
            ],
            'product' =>[
                'id' =>$orders->product->id,
                'name' =>$orders->product->product_name
            ],
            'qty' =>$orders->qty,
            'total' =>$orders->total,
            'order_date' =>$orders->order_date,
            'status' =>$orders->status
        ];
    }
}