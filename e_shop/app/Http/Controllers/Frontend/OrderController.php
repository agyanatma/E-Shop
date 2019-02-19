<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Product;
use App\Product_image;
use App\Category_product;
use App\User;
use App\Orders;
use App\Order_product;
use App\Order_detail;
use Carbon\Carbon;
use Auth;
use Stripe\Stripe;
use App\Wishlist;
use Session;
class OrderController extends Controller
{
    public function cart(){
        $products = Product::with(['images'])->get();
        $users = Auth::User();
        $buyer = Auth::user()->id;
        
        $orders = Order_product::with('product','buyer')->where('user_id','=',$buyer)->get();
        $totalorder = Order_product::with('product','buyer')->where([
            'user_id' => $buyer,
        ])->count();
        //dd($totalorder);
        $productrandom = Product::inRandomOrder()->with(['images'])->take(6)->get();
        //dd($productrandom);
        
        $total = Order_product::with('product','buyer')->where('user_id','=',$buyer )->sum('total');
        $totalqty = Order_product::with('product','buyer')->where('user_id','=',$buyer)->sum('qty');
        //dd($total);
        return view('pages.frontend.cart')->with('products', $products)->with('users', $users)
        ->with('buyer', $buyer)->with('orders', $orders)
        ->with('total', $total)->with('totalqty', $totalqty)
        ->with('productrandom', $productrandom)->with('totalorder', $totalorder);
    }

    public function updatecart(Request $request, $id){
        if($products = Product::find($id)){
            
            $quantity = $request->input('quantity');
            $user = $request->input('user_id');
            $product = $request->input('product_id');
            $price = $products->getOriginal('product_price');
            $total = $quantity * $price;
            $order = Order_product::where([
                'user_id' => $user,
                'product_id' => $product,
            ])->first();

            if ($order) {
                $order->qty = $quantity;
                $order->total = $quantity * $price;
                $order->save();
            }
            //dd($request->all());
            return redirect()->back()->with('status', 'Product edited form cart successfully!');
        }
    }


    public function deleteCart($id){
        $order = Order_product::find($id);
        $order->delete();
        return redirect()->back()->with('status', 'Data has been remove successfully');   
    }
    
    public function checkout(Request $request, $id){
       
        if($products = Product::find($id)){
            $user = $request->input('user_id');
            $product = $request->input('product_id');
            $quantity = $request->input('qty');
            $total = $products->getOriginal('product_price');
           
            $order = Order_product::where([
                'user_id' => $user,
                'product_id' => $product,
            ])->first();
            if ($order) {
                $order->qty += $quantity;
                $order->save();
            } 
            //jika belum
            else {
                $store = new Order_product;
                $store->user_id = $user;
                $store->product_id = $product;
                $store->total = $total;
                $store->qty = $quantity;
                
                $store->save();
            }
            
            return redirect()->back()->with('status', 'Product added to cart successfully!');
        }
        else{
            return redirect()->back()->with('error', 'Product added to cart successfully!');
        }
        
    }

    public function bayar(Request $request){
        $user = Auth::user();
        $order = Orders::create([
            'user_id' =>$user->id,
            'email' =>$user->email,
            'fullname' =>$user->fullname,
            'address' =>$user->address,
            'city'  =>$user->city,
            'postal_code' =>$user->postal_code,
            'order_date' =>Carbon::now(),
            'total' =>$request->get('total'),
        
        ]);
        //dd($request->all());
        $product = Order_product::with('product');
        foreach($product as $item){
            Order_detail::create([
                'order_id' =>$order->id,
                'product_id' =>$item->product_id,
                'price' =>$item->product->product_price,
                'qty' =>$item->qty
            ]);
        }

        Order_product::where('user_id',Auth::id())->delete();

        return redirect()->route('paymentcard', $order->id)->with('status','Order Success');
    }

    public function updatestatusbayarlangsung(Request $request, $id){
        
        $status = $request->all;
        $id = Auth::user()->id;
        $order = Orders::where([
            ['user_id','=',$id],
            ['status','=','0'],
        ])->update(['status' => '1']);

        return redirect()->route('userPage');
    }

    public function tambahlangsung(Request $request, $id){
        if($products = Product::find($id)){
            $user = $request->input('user_id');
            $product = $request->input('product_id');
            $quantity = $request->input('quantity', '1');
            $total = $products->getOriginal('product_price');
            //dd($request->price);
            //cek order sudah ada atau belum
            $order = Order_product::where([
                'user_id' => $user,
                'product_id' => $product,
            ])->first();
            //jika sudah ada
            if ($order) {
                $order->qty += $quantity;
                $order->save();
            } 
            //jika belum
            else {
                $store = new Order_product;
                $store->user_id = $user;
                $store->product_id = $product;
                $store->total = $total;
                $store->qty = $quantity;
               
                $store->save();
            }

        return redirect()->back()->with('status','Items has been added to cart successfully');
        }
    }

    public function langsungbayar(Request $request, $id){
        
        if($products = Product::find($id)){
            $user = $request->input('user_id');
            $product = $request->input('product_id');
            $quantity = $request->input('quantity', '1');
            $total = $products->getOriginal('product_price');
            
            
            //dd($request->price);
            //cek order sudah ada atau belum
            $order = Order_product::where([
                'user_id' => $user,
                'product_id' => $product,
            ])->first();
            //jika sudah ada
            if ($order) {
                $order->qty += $quantity;
                
                $order->save();
            } 
            //jika belum
            else {
                $store = new Order_product;
                $store->user_id = $user;
                $store->product_id = $product;
                $store->total = $total;
                $store->qty = $quantity;
                $store->save();
            }
        
        $products = Product::with(['images'])->get();
        $users = Auth::User();
        $buyer = Auth::user()->id;
        $orders = Order_product::with('product','buyer')->where('user_id','=',$buyer)->get();
        $order_details = Order_product::with('product','buyer')->where('user_id','=',$buyer)->get();//dd($orders->toArray());
        $totalorder = Order_product::with('product','buyer')->where([
            'user_id' => $buyer,
        ])->count();
        $total = Order_product::with('product','buyer')->where('user_id','=',$buyer)->sum('total');
        $totalqty = Order_product::with('product','buyer')->where('user_id','=',$buyer)->sum('qty');

            return view('pages.frontend.langsungbayargan')->with('products', $products)->with('users', $users)
            ->with('buyer', $buyer)->with('orders', $orders)
            ->with('total', $total)->with('totalqty', $totalqty)->with('totalorder', $totalorder)
            ->with('status','Items has been added to payment successfully');
        }
        else{
            return redirect()->back()->with('error','Items cant added to cart ! please check again!');
        }
    }

    public function getcheckoutgan(){
        $products = Product::with(['images'])->get();
        $users = Auth::User();
        $buyer = Auth::user()->id;
        // $ordersproduct = Orders::all();
        $orders = Order_product::with('product','buyer')->where('user_id','=',$buyer)->get();
        $totalorder = Order_product::with('product','buyer')->where([
            'user_id' => $buyer,
        ])->count();
        $total = Order_product::with('product','buyer')->where('user_id','=',$buyer)->sum('total');
        $totalqty = Order_product::with('product','buyer')->where('user_id','=',$buyer)->sum('qty');
        //dd($ordersproduct);
        return view('pages.frontend.checkoutgan')->with('products', $products)->with('users', $users)
        ->with('buyer', $buyer)->with('orders', $orders)->with('total', $total)->with('totalqty', $totalqty)
        ->with('totalorder', $totalorder);
    }

    public function paymentgan($id){
        // $orders = Orders::find($id);
        $buyer = Auth::user()->id;
        $orders = Orders::with([
            'orderDetail',
            'orderDetail.product'=>(function($product){
                $product->with(['images'])->get();
            })
        ])->where([
            'user_id' => Auth::user()->id,
        ])->find($id);
        //dd($orders->toArray);
        $totalorder = Order_product::with('product','buyer')->where([
            'user_id' => $buyer,
        ])->count();
        $total = Order_product::with('product','buyer')->where('user_id','=',$buyer)->sum('total');
        // dd($orders->toArray());
        return view('pages.frontend.payment')->with('totalorder', $totalorder)->with('total', $total)
        ->with('orders', $orders);
    }
    
    public function payment(Orders $order, $id){
        if($order->status==0){
            Orders::find($id)->update([
                'status' =>'1'
            ]);
            return redirect()->route('userPage')->with('status','Order number '.$id.' has been approved');
        }
        return redirect()->back()->with('failed','Order number '.$id.'not yet pay');

        
    }

    // public function paymentcard(Request $request, Orders $order, $id){
           
    //         if($order->status==0){
    //             $order = Orders::find($id)->update([
    //                 'status' =>'1',
    //                 'payment_check' => '1',
    //             ]);
                
                
    //             return redirect()->route('userPage')->with('status','Order number '.$id.' has been approved');
    //         }
            
        
    // }
    
    // Route::get('/pemabayaran/payment', 'Frontend\OrderController@paymentgan')->name('paymentcard');
}
