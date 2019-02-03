<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Category_product;
use App\Transformers\CategoryTransformer;
use App\Transformers\Status;


class CategoryController extends Controller
{
    public function index(Category_product $categories){
        try{
            $categories = $categories->with('product','images')->get();
            $response = fractal()
                ->collection($categories)
                ->transformWith(new ProductTransformer)
                ->includeImages()
                ->toArray();

                if(!$categories){
                    return response()->json(Status::response(null, 'error', 'Nothing Found', 404), 404);
                }
                return response()->json(Status::response($response, 'success', 'Get data success', 200), 200);
        }
        catch(\Exception $e){
            return response()->json(Status::response(null, 'error', $e->getMessage()), 404);
        }
        
    }

    
    
}
