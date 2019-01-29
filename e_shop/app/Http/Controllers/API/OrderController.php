<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Orders;
use App\Transformers\OrderTransformer;


class OrderController extends Controller
{
    public function index(Orders $orders){
        $orders = $orders->with('product', 'buyer')->get();

        $response = fractal()
            ->collection($orders)
            ->transformWith(new OrderTransformer)
            ->toArray();

        return response()->json($response, 201);
    }
    
    public function order(Request $request, Orders $order){
        $this->validate($request,[
            'order_date' => 'required',
            'product_id' => 'required',
            'qty' => 'required',
            'total' => 'required',
        ]);

        $order = $order->create([
            'order_date' =>$request->order_date,
            'user_id' =>Auth::user()->id,
            'product_id' =>$request->product_id,
            'qty' =>$request->qty,
            'total' =>$request->total,
        ]);

        $response = fractal()
            ->item($order)
            ->transformWith(new OrderTransformer)
            ->toArray();

        return response()->json($response, 201);
    }

    public function payed(Request $request, Order $order){
        
    }
}
