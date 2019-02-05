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

    public function transform(Category_product $categories){
        return [
            'id' =>$categories->id,
            'name' =>$categories->category_name,
            'image' =>[
                'id' =>$categories->images->id,
                'url' =>'http://bukanjaknote.site/upload/'.$categories->images->category_image
            ]
        ];
    }

    public function includeProducts(Category_product $categories){
        $products = $categories->product;
        return $this->collection($products, new ProductTransformer);
    }
}