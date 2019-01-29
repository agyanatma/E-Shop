<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Category_product;
use App\Transformers\CategoryTransformer;


class CategoryController extends Controller
{
    public function index(Category_product $category){
        $category = $category->all();

        $response = fractal()
            ->collection($category)
            ->transformWith(new CategoryTransformer)
            ->includeProduct()
            ->toArray();

        return response()->json($response, 201);
    }
    
}
