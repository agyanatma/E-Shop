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
            $categories = $categories->with(['product','product.images'])->get();

            if(!$categories){
                return response()->json([
                    'categories'=>array(), 
                    'status'    =>'error',
                    'message'   =>'Nothing Happen',
                    'code'      =>'404'], 404);
            }
            return response()->json([
                'categories'=>$categories, 
                'status'    =>'success',
                'message'   =>'Get data success',
                'code'      =>'200'], 200);
        }
        catch(\Exception $e){
            return response()->json([
                'categories'=>array(), 
                'status'    =>'error',
                'message'   =>$e->getMessage(),
                'code'      =>'404'], 404);
        }
        
    }

    public function sort(Category_product $categories, $id){
        try{
            $categories = $categories->with(['product','product.images'])->find($id);
            //dd($categories->toArray());
            
            if(!$categories){
                return response()->json([
                    'categories'=>array(), 
                    'status'    =>'error',
                    'message'   =>'Nothing Happen',
                    'code'      =>'404'], 404);
            }
            return response()->json([
                'categories'=>$categories, 
                'status'    =>'success',
                'message'   =>'Get data success',
                'code'      =>'200'], 200);
        }
        catch(\Exception $e){
            return response()->json([
                'categories'=>array(), 
                'status'    =>'error',
                'message'   =>$e->getMessage(),
                'code'      =>'404'], 404);
        }   
    }
    
}
