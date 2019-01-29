<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Product;
use App\Transformers\ProductTransformer;


class ProductController extends Controller
{
    public function index(Product $product){
        $product = $product->with('categories')->get();

        $response = fractal()
            ->collection($product)
            ->transformWith(new ProductTransformer)
            ->includeImages()
            ->toArray();

        return response()->json($response, 201);
    }
    
}
