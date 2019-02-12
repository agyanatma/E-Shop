<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Product;
use App\Product_image;
use App\Category_product;
use App\User;
use App\Orders;
use Carbon\Carbon;
use Auth;
use Stripe\Stripe;
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

    public function cart(){
        $products = Product::with(['images'])->get();
        $users = Auth::User();
        $buyer = Auth::user()->id;
        $orders = Orders::with('product','buyer')->where('user_id','=',$buyer)->get();
        $categories = Category_product::all();
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
        ->with('buyer', $buyer)->with('orders', $orders)->with('category', $categories)
        ->with('total', $total)->with('totalqty', $totalqty)->with('qty', $qty)
        ->with('productrandom', $productrandom)->with('totalorder', $totalorder);
    }

    public function deleteCart($id){
        $order = Orders::find($id);
        $order->delete();
        return redirect()->back()->with('status', 'Data berhasil dihapus');   
    }
    
    public function checkout(Request $request, $id){
        if($products = Product::find($id)){
            $user = $request->input('user_id');
            $product = $request->input('product_id');
            $quantity = $request->input('quantity');
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
            
            return redirect()->back()->with('status', 'Product added to cart successfully!');
        }
        // else {
        //     $order = Orders::find($id)->where('product_id', '=', $id);
        //     $products['quantity']+= $quantity;
        //     dd($products);
        //     return redirect()->back()->with('success', 'Product added to cart successfully!');
        // }
        
    }
        

    public function updatestatus(Request $request, $id){
        
        /*$buyer = Auth::user()->id;
        $order = $request->get('order_id');
        $user = $request->get('user_id');
        $product = $request->get('product_id');
        $quantity = $request->get('quantity');
        $price = $request->get('product_price');
        $time = Carbon::today();
        //dd($request->all());
        $update = Order::find($id);
        $update->user_id = $user_id;
        $update->product_id = $product_id;
        $update->quantity = $quantity;
        $update->product_price = $product_price;
        $update->time = $time;*/
        //dd($orders->toArray());
        $status = $request->all;
        $id = Auth::user()->id;
        $order = Orders::where([
            ['user_id','=',$id],
            ['status','=','0'],
        ])->update(['status' => '1']);

        
        //dd($request->toArray());
        //$order->status = '1';
        //$order->save();
        
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

        return redirect()->back()->with('status','Barang berhasil ditambah ke keranjang');
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
        $categories = Category_product::all();
        $totalorder = Orders::with('product','buyer')->where([
            'user_id' => $buyer,
            'status' => 0,
        ])->count();
        
        $total = Orders::with('product','buyer')->where('user_id','=',$buyer)->where('status', '=', '0')->get()->sum('total');
        $totalqty = Orders::with('product','buyer')->where('user_id','=',$buyer)->where('status', '=', '0')->get()->sum('qty');
        //dd($orders->toArray());
        //dd($total);
            return view('pages.frontend.langsungbayargan')->with('products', $products)->with('users', $users)
            ->with('buyer', $buyer)->with('orders', $orders)->with('category', $categories)
            ->with('total', $total)->with('totalqty', $totalqty)->with('totalorder', $totalorder);
            }
        return view('pages.frontend.langsungbayargan')->with('users', $users)->with('buyer', $buyer)
        ->with('orders', $orders)
        ->with('status','Barang berhasil ditambah ke pembayaran');
        }
    }

    public function getcheckoutgan(){
        $products = Product::with(['images'])->get();
        $users = Auth::User();
        $buyer = Auth::user()->id;
        $orders = Orders::with('product','buyer')->where('user_id','=',$buyer)->get();
        //dd($orders->toArray());
        $categories = Category_product::all();
        $totalorder = Orders::with('product','buyer')->where([
            'user_id' => $buyer,
            'status' => 0,
        ])->count();
        $total = Orders::with('product','buyer')->where('user_id','=',$buyer)->where('status', '=', '0')->sum('total');
        $totalqty = Orders::with('product','buyer')->where('user_id','=',$buyer)->where('status', '=', '0')->sum('qty');
        
        return view('pages.frontend.checkoutgan')->with('products', $products)->with('users', $users)
        ->with('buyer', $buyer)->with('orders', $orders)->with('category', $categories)
        ->with('total', $total)->with('totalqty', $totalqty)->with('totalorder', $totalorder);
    }

   
}
