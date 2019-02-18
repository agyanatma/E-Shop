<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Orders;
use App\Order_product;
use App\Order_detail;
use App\User;
use App\Product;
use App\Transformers\OrderTransformer;
use App\Transformers\Status;
use Auth;
use Validator;
use Carbon\Carbon;


class OrderController extends Controller
{
    public function index(Orders $orders){
        try{
            $orders = Orders::with(['orderDetail','orderDetail.product'])->get();

            if(!$orders){
                return response()->json([
                    'orders'    =>array(), 
                    'status'    =>'error',
                    'message'   =>'Nothing Happen',
                    'code'      =>'404'], 404);
            }

            if(!count($orders)>0){
                return response()->json([
                    'cart'      =>array(), 
                    'status'    =>'success',
                    'message'   =>'Cart empty',
                    'code'      =>'200'], 200);
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

    public function cart(Order_product $cart, User $user, Product $product){
        try{
            //dd($user->toArray());
            $cart = Order_product::with([
                'buyer' =>(function($user){
                    $user->select('id','fullname')->get();
                }),
                'product' =>(function($product){
                    $product->with('image')->select('id','product_name')->get();
                })
            ])->get();

            if(!$cart){
                return response()->json([
                    'cart'      =>array(), 
                    'status'    =>'success',
                    'message'   =>'Nothing Happen',
                    'code'      =>'200'], 200);
            }

            if(!count($cart)>0){
                return response()->json([
                    'cart'      =>array(), 
                    'status'    =>'success',
                    'message'   =>'Cart empty',
                    'code'      =>'200'], 200);
            }
    
            return response()->json([
                'cart'      =>$cart, 
                'status'    =>'success',
                'message'   =>'Get data success',
                'code'      =>'200'], 200);
        }
        catch(\Exception $e){
            return response()->json([
                'cart'      =>array(), 
                'status'    =>'error',
                'message'   =>$e->getMessage(),
                'code'      =>'404'], 404);
        }
    }

    public function addCart(Request $request, Order_product $cart, User $user, Product $product){
        try{
            Order_product::create([
                'user_id' =>Auth::id(),
                'product_id' =>$request->get('product_id'),
                'price' =>$request->get('price'),
                'qty' =>$request->get('qty'),
                'total' =>$request->get('total'),
            ]);

            $cart = Order_product::with([
                'buyer' =>(function($user){
                    $user->select('id','fullname')->get();
                }),
                'product' =>(function($product){
                    $product->with('image')->select('id','product_name')->get();
                })
            ])->latest()->first();

            if(!$cart){
                return response()->json([
                    'cart'      =>array(), 
                    'status'    =>'success',
                    'message'   =>'Nothing Happen',
                    'code'      =>'200'], 200);
            }
    
            return response()->json([
                'cart'      =>$cart, 
                'status'    =>'success',
                'message'   =>'Add to Cart success',
                'code'      =>'200'], 200);
        }
        catch(\Exception $e){
            return response()->json([
                'cart'      =>array(), 
                'status'    =>'error',
                'message'   =>$e->getMessage(),
                'code'      =>'404'], 404);
        }
        
    }

    public function editCart(Request $request, Order_product $cart, User $user, Product $product, $id){
        try{
            Order_product::findOrFail($id)->update([
                'qty' =>$request->get('qty')
            ]);
    
            $cart = Order_product::with([
                'buyer' =>(function($user){
                    $user->select('id','fullname')->get();
                }),
                'product' =>(function($product){
                    $product->with('image')->select('id','product_name')->get();
                })
            ])->findOrFail($id);
            
            if(!$cart){
                return response()->json([
                    'cart'      =>array(), 
                    'status'    =>'success',
                    'message'   =>'Nothing Happen',
                    'code'      =>'200'], 200);
            }
    
            return response()->json([
                'cart'     =>$cart, 
                'status'    =>'success',
                'message'   =>'Add to Cart success',
                'code'      =>'200'], 200);
        }
        catch(\Exception $e){
            return response()->json([
                'cart'      =>array(), 
                'status'    =>'error',
                'message'   =>$e->getMessage(),
                'code'      =>'404'], 404);
        }
    }

    public function deleteCart(Request $request, Order_product $cart, $id){
        try{
            Order_product::findOrFail($id)->delete();

        if(!$cart){
            return response()->json([
                'cart'      =>array(), 
                'status'    =>'success',
                'message'   =>'Nothing Happen',
                'code'      =>'200'], 200);
        }

        return response()->json([
            'cart'      =>array(), 
            'status'    =>'success',
            'message'   =>'Delete success',
            'code'      =>'200'], 200);
        }
        catch(\Exception $e){
            return response()->json([
                'cart'      =>array(), 
                'status'    =>'error',
                'message'   =>$e->getMessage(),
                'code'      =>'404'], 404);
        }
    }

    public function order(Request $request, Orders $order, Product $product){
        try{
            $user = Auth::user();            
            $product = Order_product::where('user_id',Auth::id())->get();
            if(!count($product)>0){
                return response()->json([
                    'order'     =>array(), 
                    'status'    =>'failed',
                    'message'   =>'You do not have any order',
                    'code'      =>'422'], 422);
            }
            $order = Orders::create([
                'user_id' =>$user->id,
                'email' =>$user->email,
                'fullname' =>$user->fullname,
                'address' =>$user->address,
                'city'  =>$user->city,
                'postal_code' =>$user->postal_code,
                'order_date' =>Carbon::now(),
                'total' =>$request->get('total')
            ]);
            
            foreach($product as $item){
                Order_detail::create([
                    'order_id' =>$order->id,
                    'product_id' =>$item->product_id,
                    'price' =>$item->price,
                    'qty' =>$item->qty
                ]);
            }

            $item = Orders::with([
                'orderDetail',
                'orderDetail.product'=>(function($product){
                    $product->with('image')->select('id','product_name')->get();
                })
            ])->latest()->first();

            if(!$order){
                return response()->json([
                    'cart'      =>array(), 
                    'status'    =>'success',
                    'message'   =>'Nothing Happen',
                    'code'      =>'200'], 200);
            }

            return response()->json([
                'order'     =>$item, 
                'status'    =>'success',
                'message'   =>'Order success',
                'code'      =>'200'], 200);
            
            Order_product::where('user_id',Auth::id())->delete();
        }
        catch(\Exception $e){
            return response()->json([
                'order'     =>array(), 
                'status'    =>'error',
                'message'   =>$e->getMessage(),
                'code'      =>'404'], 404);
        }
    }
    
    /*public function order(Request $request, Orders $orders){
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
    }*/

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
