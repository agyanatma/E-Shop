<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Product;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [

            'name' =>$this->product_name,
            //'category' =>$this->categories->category_name,
            'price' =>$this->product_price,
            'description' =>$this->description,
            //'images' =>$this->images->product_image,

        ];
    }
}
