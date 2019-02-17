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
    public function listpembelian(){
        //$orders = Order::all();
        //$products = Product::with(['images'])->find($id);
        $users = Auth::User();
        //Cart::add($request->id, $request->name, 1, $request->price)->associate('App\Product');
        //$categories = Category_product::all();
        return view('pages.frontend.listpembelian')->with('users', $users);
    }

   

    // $wishlist = Wishlist::where([
    //     'user_id' => Auth::id()
    // ]);
    // if ($request->has('title') && $request->get('title') != '') {
    //     //dd($keyword);
    //     $wishlist->whereHas('product', function ($q) use ($keyword) {
    //         $q->where('product_name', 'like', '%'.$keyword.'%');
    //     });
    // }
    public function cart(){
        $products = Product::with(['images'])->get();
        $users = Auth::User();
        $buyer = Auth::user()->id;
        
        $orders = Order_product::with('product','buyer')->where('user_id','=',$buyer)->get();

        // $orders->whereHas('Order_product');
        dd($orders->toArray());
        $totalorder = Orders::with('product','buyer')->where([
            'user_id' => $buyer,
            'status' => 0,
        ])->count();
        //dd($totalorder);
        $productrandom = Product::inRandomOrder()->with(['images'])->take(6)->get();
        //dd($productrandom);
        $qty = Orders::with('product','buyer')->where('user_id','=',$buyer )->where('status', '=', '0');
        $total = Orders::with('product','buyer')->where('user_id','=',$buyer )->where('status', '=', '0')->sum('total');
        $totalqty = Orders::with('product','buyer')->where('user_id','=',$buyer)->where('status', '=', '0')->sum('qty');
        //dd($id);
        return view('pages.frontend.cart')->with('products', $products)->with('users', $users)
        ->with('buyer', $buyer)->with('orders', $orders)
        ->with('total', $total)->with('totalqty', $totalqty)->with('qty', $qty)
        ->with('productrandom', $productrandom)->with('totalorder', $totalorder);
    }

    public function updatecart(Request $request, $id){
        if($products = Product::find($id)){
            
            $quantity = $request->input('quantity');
            $user = $request->input('user_id');
            $product = $request->input('product_id');
            $price = $request->input('price');
            $order = Orders::where([
                'user_id' => $user,
                'product_id' => $product,
                'status' => 0,
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
        $order = Orders::find($id);
        $order->delete();
        return redirect()->back()->with('status', 'Data has been remove successfully');   
    }
    
    public function checkout(Request $request, $id){
       
        if($products = Product::find($id)){
            
            $user = $request->input('user_id');
            $product = $request->input('product_id');
            $quantity = $request->input('quantity');
            $price = $request->input('price');
            $time = Carbon::today();
            dd($request->price);
            //cek order sudah ada atau belum
            $order = Orders::where([
                'user_id' => $user,
                'product_id' => $product,
                'status' => 0,
            ])->first();
            //jika sudah ada
            if ($order) {
                $order->qty += $quantity;
                $order->total += $quantity * $price;
                $order->save();
            } 
            //jika belum
            else {
                $store = new Orders;
                $store->order_date = $time;
                $store->user_id = $user;
                $store->product_id = $product;
                $store->price = $price;
                $store->qty = $quantity;
                $store->total = $quantity * $price;
                $store->save();
            }
            
            return redirect()->back()->with('status', 'Product added to cart successfully!');
        }
        else{
            return redirect()->back()->with('error', 'Product added to cart successfully!');
        }
        
    }
        

    public function updatestatus(Request $request, $id){
        
        $status = $request->all;
        $id = Auth::user()->id;
        $order = Orders::where([
            ['user_id','=',$id],
            ['status','=','0'],
        ])->update(['status' => '1']);

        return redirect()->route('userPage');
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
            $price = $request->input('price');
            $time = Carbon::today();
            //dd($request->price);
            //cek order sudah ada atau belum
            $order = Orders::where([
                'user_id' => $user,
                'product_id' => $product,
                'status' => 0,
            ])->first();
            //jika sudah ada
            if ($order) {
                $order->qty += $quantity;
                $order->total += $quantity * $price;
                $order->save();
            } 
            //jika belum
            else {
                $store = new Orders;
                $store->order_date = $time;
                $store->user_id = $user;
                $store->product_id = $product;
                $store->price = $price;
                $store->qty = $quantity;
                $store->total = $quantity * $price;
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
            $price = $request->input('price');
            $time = Carbon::today();
            //dd($request->price);
            //cek order sudah ada atau belum
            $order = Orders::where([
                'user_id' => $user,
                'product_id' => $product,
                'status' => 0,
            ])->first();
            //jika sudah ada
            if ($order) {
                $order->qty += $quantity;
                $order->total += $quantity * $price;
                $order->save();
            } 
            //jika belum
            else {
                $store = new Orders;
                $store->order_date = $time;
                $store->user_id = $user;
                $store->product_id = $product;
                $store->price = $price;
                $store->qty = $quantity;
                $store->total = $quantity * $price;
                $store->save();
            }
            
        
        if (Auth::user() && $orders = 1){
        $products = Product::with(['images'])->get();
        $users = Auth::User();
        $buyer = Auth::user()->id;
        $orders = Orders::with('product','buyer')->where('user_id','=',$buyer)->where('status', '=', '0')->get();
        //dd($orders->toArray());
        $totalorder = Orders::with('product','buyer')->where([
            'user_id' => $buyer,
            'status' => 0,
        ])->count();
        
        $total = Orders::with('product','buyer')->where('user_id','=',$buyer)->where('status', '=', '0')->get()->sum('total');
        $totalqty = Orders::with('product','buyer')->where('user_id','=',$buyer)->where('status', '=', '0')->get()->sum('qty');
        //dd($orders->toArray());
        //dd($total);
            return view('pages.frontend.langsungbayargan')->with('products', $products)->with('users', $users)
            ->with('buyer', $buyer)->with('orders', $orders)
            ->with('total', $total)->with('totalqty', $totalqty)->with('totalorder', $totalorder)
            ->with('status','Items has been added to payment successfully');
            }
        return view('pages.frontend.langsungbayargan')->with('users', $users)->with('buyer', $buyer)
        ->with('orders', $orders)
        ->with('status','Items has been added to payment successfully');
        }
    }

    public function getcheckoutgan(){
        $products = Product::with(['images'])->get();
        $users = Auth::User();
        $buyer = Auth::user()->id;
        $orders = Orders::with('product','buyer')->where('user_id','=',$buyer)->get();
        //dd($orders->toArray());
        $totalorder = Orders::with('product','buyer')->where([
            'user_id' => $buyer,
            'status' => 0,
        ])->count();
        $total = Orders::with('product','buyer')->where('user_id','=',$buyer)->where('status', '=', '0')->sum('total');
        $totalqty = Orders::with('product','buyer')->where('user_id','=',$buyer)->where('status', '=', '0')->sum('qty');
        
        return view('pages.frontend.checkoutgan')->with('products', $products)->with('users', $users)
        ->with('buyer', $buyer)->with('orders', $orders)->with('total', $total)->with('totalqty', $totalqty)->with('totalorder', $totalorder);
    }

   
}
