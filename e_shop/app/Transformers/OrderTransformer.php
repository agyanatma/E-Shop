<?php

namespace App\Transformers;

use App\Orders;
use App\Transformers\ProductTransformer;
use League\Fractal\TransformerAbstract;

class OrderTransformer extends TransformerAbstract
{   
    protected $availableIncludes = [
        'product'
    ];

    public function transform(Orders $orders){
        $images = $orders->product->images;
        return [
            'id' =>$orders->id,
            'user' =>[
                'data'=>[[
                    'id' =>$orders->buyer->id,
                    'email' =>$orders->buyer->email,
                    'fullname' =>$orders->buyer->fullname,
                    'address' =>$orders->buyer->address,
                    'city' =>$orders->buyer->city,
                    'postal_code' =>$orders->buyer->postal_code
                ]]
            ],
            'qty' =>$orders->qty,
            'total' =>$orders->total,
            'order_date' =>$orders->order_date,
            'status' =>$orders->status
        ];
    }

    public function includeProduct(Orders $orders){
        $product = $orders->product;
        return $this->collection($product, new ProductTransformer);
    }
}