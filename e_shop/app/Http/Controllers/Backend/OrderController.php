<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::all();
        return view('pages.admin.index_order')->with('orders', $orders);
    }

    public function storeProduct(){

    }

    //FRONT END
    public function checkout(){
        $products = Product::get();
        $users = User::get_browser();
    }
}
