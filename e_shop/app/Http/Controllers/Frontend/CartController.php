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
        $products = Product::with(['images'])->inRandomOrder()->take(4)->get();
        $users = session()->get('user_session');
        $buyer = $users->id;
        $orders = Orders::with('product','buyer')->where('user_id','=',$buyer)->get();
        //dd($orders->toArray());
        
        $categories = Category_product::all();
        $total = Orders::all()->sum('amount');
        return view('pages.frontend.cartblog')->with('products', $products)->with('users', $users)->with('buyer', $buyer)->with('orders', $orders)->with('category', $categories)->with('total', $total);
    }
    
    public function create(){
        
    }

    public function store(){
        Cart::add($request->product_id, $request->product_name, $request->product_price, $request->description )->assosiate('App\Product');
        dd($cart->toArray);
        return redirect()->route('pages.frontend.cartblogindex')->with('success_message', 'Item was added to your cart !!');
    }
    // public function store(Request $request){
    //     order::add($request->id, $request->name, 1, $request->price)->
    // }

}
