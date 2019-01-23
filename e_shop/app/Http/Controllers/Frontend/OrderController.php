<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::all();
        return view('pages.order')->with('orders', $orders);
    }
    public function order(){
        $title = 'ORDER';
        //return view ('pages.index', compact ('title'));
        return view ('pages.frontend.order')->with ('title', $title);
    }
}
