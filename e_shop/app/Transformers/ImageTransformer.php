<?php

namespace App\Transformers;

use App\Product_image;
use League\Fractal\TransformerAbstract;

class ImageTransformer extends TransformerAbstract
{
    public function transform(Product_Image $images){
        return [
            'id' =>$images->id,
            'url' => '/upload/'.$images->product_image,
        ];
    }
}