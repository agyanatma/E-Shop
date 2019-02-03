<?php

namespace App\Transformers;

use App\Product;
use App\Transformers\ImageTransformer;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'images'
    ];

    public function transform(Product $product){
        return [
            'id' =>$product->id,
            'name' =>$product->product_name,
            'category' =>$product->categories->category_name,
            'price' =>$product->product_price,
            'description' =>$product->description
        ];
    }

    public function includeImages(Product $product){
        $images = $product->images;
        return $this->collection($images, new ImageTransformer);
    }
}