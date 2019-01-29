<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Product;
use App\Product_image;
use App\Category_product;
use App\User;
use App\Orders;

class CartController extends Controller
{
    public function index(){

        $products = Product::with(['images'])->get();
        $categories = Category_product::all();
        $users = User::get();
        dd($products);
        return view('pages.frontend.cart')->with('products', $products)->with('categories', $categories)->with('users', $users);
    }
    
    public function create(){
        
    }

    // public function store(Request $request){
    //     order::add($request->id, $request->name, 1, $request->price)->
    // }
}
