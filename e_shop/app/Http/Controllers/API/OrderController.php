<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Orders;
use App\Transformers\OrderTransformer;
use App\Transformers\Status;


class OrderController extends Controller
{
    public function index(Orders $orders){
        try{
        $orders = $orders->with('product','product.images', 'buyer')->get();

        $response = [
            'orders' =>$orders
        ];

            if(!$orders){
                return response()->json(Status::response(null, 'error', 'Nothing Found', 404), 404);
            }
            return response()->json(Status::response($response, 'success', 'Get data success', 200), 200);
        }
        catch(\Exception $e){
            return response()->json(Status::response(null, 'error', $e->getMessage()), 404);
        }
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

        $response = [
            'order' =>$order
        ];

        return response()->json($response, 201);
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
                return response()->json(Status::response(null, 'error', 'Nothing Found', 404), 404);
            }
            if($order->status!='1'){
                return response()->json(Status::response($response, 'failed', 'Nothing Happen', 401), 401);
            }
            return response()->json(Status::response($response, 'success', 'Waiting for confirmation', 200), 200);
        }
        catch(\Exception $e){
            return response()->json(Status::response(null, 'error', $e->getMessage()), 404);
        }
        
    }
}
