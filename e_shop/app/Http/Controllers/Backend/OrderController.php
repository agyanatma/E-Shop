<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::all();
        return view('pages.order')->with('orders', $orders);
    }
}
