<?php

namespace App\Transformers;

use App\Category_product;
use App\Transformers\ProductTransformer;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'product'
    ];

    public function transform(Category_product $category){
        return [
            'id' =>$category->id,
            'name' =>$category->category_name,
            'image' =>'/upload/'.$category->category_image,
        ];
    }

    public function includeProducts(Category_product $category){
        $product = $category->product;
        return $this->collection($product, new ProductTransformer);
    }
}