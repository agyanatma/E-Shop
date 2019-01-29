<?php

namespace App\Transformers;

use App\Category_product;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    public function transform(Category_product $category){
        return [
            'id' =>$category->id,
            'name' =>$category->category_name,
            'iamge' =>'/upload/'.$category->category_image,
        ];
    }
}