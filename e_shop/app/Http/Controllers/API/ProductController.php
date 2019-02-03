<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Product;
use App\Transformers\ProductTransformer;
use App\Transformers\Status;


class ProductController extends Controller
{
    public function index(Product $product){
        try{
            $product = $product->with(['categories','images'])->get();

            $response = fractal()
            ->collection($product)
            ->transformWith(new ProductTransformer)
            ->includeImages()
            ->toArray();
        
            if(!$product){
                return response()->json(Status::response(null, 'error', 'Nothing Found', 404), 404);
            }
            return response()->json(Status::response($response, 'success', 'Get data success', 200), 200);
        }
        catch(\Exception $e){
            return response()->json(Status::response(null, 'error', $e->getMessage()), 404);
        }
    }
}
