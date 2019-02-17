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

            if(!$orders){
                return response()->json([
                    'orders'    =>array(), 
                    'status'    =>'error',
                    'message'   =>'Nothing Happen',
                    'code'      =>'404'], 404);
            }
            return response()->json([
                'orders'    =>$orders, 
                'status'    =>'success',
                'message'   =>'Get data success',
                'code'      =>'200'], 200);
            }
        catch(\Exception $e){
            return response()->json([
                'orders'    =>array(), 
                'status'    =>'error',
                'message'   =>$e->getMessage(),
                'code'      =>'404'], 404);
        }
    }
    
    public function order(Request $request, Orders $orders){
        $validate = \Validator::make($request->all(),[
            'product' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'total' => 'required|numeric',
            'order_date' => 'required'
        ]);
        if($validate->fails()){
            return response()->json([
                'orders'    =>array(), 
                'status'    =>'failed',
                'message'   =>$validate->messages()->first(),
                'code'      =>'422'], 422);
        }
        
        try{
            $item = new Orders;
            $item->user_id = Auth::id();
            $item->product_id = $request->product;
            $item->price = $request->price;
            $item->qty = $request->quantity;
            $item->total = $request->total;
            $item->order_date = $request->order_date;
            $item->save()->with('product','product.images', 'buyer');

            //$orders = $orders->with('product','product.images', 'buyer')->latest()->get();

            if(!$orders){
                return response()->json([
                    'orders'    =>array(), 
                    'status'    =>'error',
                    'message'   =>'Nothing Happen',
                    'code'      =>'404'], 404);
            }
            return response()->json([
                'orders'    =>$orders, 
                'status'    =>'success',
                'message'   =>'Order success',
                'code'      =>'200'], 200);
            }
        catch(\Exception $e){
            return response()->json([
                'orders'    =>array(), 
                'status'    =>'error',
                'message'   =>$e->getMessage(),
                'code'      =>'404'], 404);
        }
    }

    public function confirm(Request $request, Orders $orders, $id){
        try{
            $orders = Orders::with('product','product.images', 'buyer')->find($id);
            if($orders->status==0){
                $orders->status = '1';
                $orders->save();
            }
            
            if(!$orders){
                return response()->json([
                    'orders'    =>array(), 
                    'status'    =>'error',
                    'message'   =>'Nothing Happen',
                    'code'      =>'404'], 404);
            }
            if($orders->status!='1'){
                return response()->json([
                    'orders'    =>array(), 
                    'status'    =>'failed',
                    'message'   =>'Nothing Happen',
                    'code'      =>'401'], 401);
            }
            return response()->json([
                'orders'    =>$orders, 
                'status'    =>'success',
                'message'   =>'Waiting confirmation',
                'code'      =>'200'], 200);
            }
        catch(\Exception $e){
            return response()->json([
                'orders'    =>array(), 
                'status'    =>'error',
                'message'   =>$e->getMessage(),
                'code'      =>'404'], 404);
        }
    }

    public function history(Orders $orders){
        try{
        $orders = $orders->with(['product','product.images'])->where('user_id', Auth::id())->get();

        if(!$orders){
            return response()->json([
                'orders'    =>array(), 
                'status'    =>'error',
                'message'   =>'Nothing Happen',
                'code'      =>'404'], 404);
        }
        return response()->json([
            'orders'    =>$orders, 
            'status'    =>'success',
            'message'   =>'Get data success',
            'code'      =>'200'], 200);
        }
        catch(\Exception $e){
            return response()->json([
                'orders'    =>array(), 
                'status'    =>'error',
                'message'   =>$e->getMessage(),
                'code'      =>'404'], 404);
        }
    }

    public function destroy($id){
        try{
            $item = Orders::find($id);
            $item->delete();

            if(!$item){
                return response()->json([
                    'orders'    =>array(), 
                    'status'    =>'error',
                    'message'   =>'Nothing Happen',
                    'code'      =>'404'], 404);
            }
            return response()->json([
                'orders'    =>array(), 
                'status'    =>'success',
                'message'   =>'Order success',
                'code'      =>'200'], 200);
        }
        catch(\Exception $e){
            return response()->json([
                'orders'    =>array(), 
                'status'    =>'error',
                'message'   =>$e->getMessage(),
                'code'      =>'404'], 404);
        }
    }
}
