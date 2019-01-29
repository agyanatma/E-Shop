<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Product;


class ProductController extends Controller
{
    public function item(){
        $products = Product::all();

        return response()->json($products);
    }
    
}
