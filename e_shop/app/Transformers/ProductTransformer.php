<?php

namespace App\Transformers;

use App\Product;
use App\Product_image;
use App\Orders;
use App\Transformers\ImageTransformer;
use App\Transformers\OrderTransformer;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'images',
    ];

    public function transform(Product $product){
        return [
            'id' =>$product->id,
            'name' =>$product->product_name,
            'category' =>[
                'id' =>$product->categories->id,
                'name' =>$product->categories->category_name,
                'image' =>'/upload/'.$product->categories->category_image
            ],
            'price' =>$product->product_price,
            'description' =>$product->description,
        ];
    }

    public function includeImages(Product $product){
        $images = $product->images;
        return $this->collection($images, new ImageTransformer);
    }
}