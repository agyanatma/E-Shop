<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Orders;
use App\Transformers\OrderTransformer;
use App\Transformers\Status;
use Auth;
use Validator;


class OrderController extends Controller
{
    public function index(Orders $orders){
        try{
        $orders = $orders->with('product','product.images', 'buyer')->get();

        $response = [
            'orders' =>$orders
        ];

            if(!$orders){
                return response()->json(Status::response(array(), 'error', 'Nothing Found', 404), 404);
            }
            return response()->json(Status::response($response, 'success', 'Get data success', 200), 200);
        }
        catch(\Exception $e){
            return response()->json(Status::response(array(), 'error', $e->getMessage()), 404);
        }
    }
    
    public function order(Request $request, Orders $order){
        $validate = \Validator::make($request->all(),[
            'buyer' => 'required',
            'product' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'total' => 'required|numeric',
            'order_date' => 'required'
        ]);
        if($validate->fails()){
            return response()->json(Status::response(array(), 'failed', $validate->messages()->first(), 422), 422);
        }
        
        try{
            $order = new Orders();
            $order->user_id = $request->buyer;
            $order->product_id = $request->product;
            $order->price = $request->price;
            $order->qty = $request->quantity;
            $order->total = $request->total;
            $order->order_date = $request->order_date;
            $order->save();

            $response = [
                'order' =>$order
            ];

            if(!$order){
                return response()->json(Status::response(array(), 'error', 'Nothing Found', 404), 404);
            }
            return response()->json(Status::response($response, 'success', 'Ordering success', 200), 200);
        }
        catch(\Exception $e){
            return response()->json(Status::response(array(), 'error', $e->getMessage()), 404);
        }
    }

    public function confirm(Request $request, Orders $orders, $id){
        try{
            $order = Orders::with('product','product.images', 'buyer')->find($id);
            if($order->status==0){
                $order->status = '1';
                $order->save();
            }
            $response = [
                'order' =>$order
            ];
            if(!$order){
                return response()->json(Status::response(array(), 'error', 'Nothing Found', 404), 404);
            }
            if($order->status!='1'){
                return response()->json(Status::response($response, 'failed', 'Nothing Happen', 401), 401);
            }
            return response()->json(Status::response($response, 'success', 'Waiting for confirmation', 200), 200);
        }
        catch(\Exception $e){
            return response()->json(Status::response(array(), 'error', $e->getMessage()), 404);
        }
        
    }
}
