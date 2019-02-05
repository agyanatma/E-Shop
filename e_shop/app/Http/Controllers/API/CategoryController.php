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
                ->transformWith(new CategoryTransformer)
                ->includeProduct()
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

    public function sort($id){
        try{
            $categories = Category_product::with(['product','product.images'])->find($id);
            //dd($categories->toArray());
            
            $response = [
                'category' =>$categories
            ];

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
