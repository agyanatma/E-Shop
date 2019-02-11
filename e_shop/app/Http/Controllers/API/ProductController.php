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
        
            if(!$product){
                return response()->json([
                    'product'   =>array(), 
                    'status'    =>'error',
                    'message'   =>'Nothing Happen',
                    'code'      =>'404'], 404);
            }
            return response()->json([
                'product'   =>$product, 
                'status'    =>'success',
                'message'   =>'Get data success',
                'code'      =>'200'], 200);
        }
        catch(\Exception $e){
            return response()->json([
                'product'   =>array(), 
                'status'    =>'error',
                'message'   =>$e->getMessage(),
                'code'      =>'404'], 404);
        }
    }
}
