<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Product;
use App\Product_image;
use App\Category_product;
use App\User;
use App\Orders;
use Carbon\Carbon;

class OrderController extends Controller
{
    // public function index(){
    //     $orders = Order::all();
    //     return view('pages.order')->with('orders', $orders);
    // }

    public function order(){
        $title = 'ORDER';
        //return view ('pages.index', compact ('title'));
        return view ('pages.frontend.order')->with ('title', $title);
    }

    public function listpembelian(){
        //$orders = Order::all();
        //$products = Product::with(['images'])->find($id);
        $users = session()->get('user_session');
        //Cart::add($request->id, $request->name, 1, $request->price)->associate('App\Product');
        //$categories = Category_product::all();
        return view('pages.frontend.listpembelian')->with('users', $users);
    }

    public function store(Request $request){
        Cart::add('293ad', 'Product 1', 1, 9.99);
        
        return redirect()->route('cart.index')->with('success_message', 'Item was added to your cart');
    }

    public function cart(){
        $products = Product::with(['images'])->find($id);
        $id = $products->id;
        $users = session()->get('user_session');
        $buyer = $users->id;
        $orders = Orders::with('product','buyer')->where('user_id','=',$buyer);
        //dd($orders->toArray());

        return view('pages.frontend.checkout')->with('products', $products)->with('users', $users)->with('buyer', $buyer)->with('orders', $orders);
    }


    // public function cartstore(){
    //     return redirect()->back()->with('status', 'Cart telah berhasil di tambah ke')
    // }
    public function checkout(Request $request){
        $user = $request->input('user_id');
        $product = $request->input('product_id');
        $quantity = $request->input('quantity');
        $price = $request->input('product_price');
        $time = Carbon::today();
        //dd($product);

        $store = new Orders;
        $store->order_date = $time;
        $store->user_id = $user;
        $store->product_id = $product;
        $store->qty = $quantity;
        $store->total = $price;
        $store->save();

        return redirect()->back()->with('success_message','Barang berhasil ditambah ke keranjang');
    }

    // public function bayar(Request $request){
    //     $user = $request->input('user_id');
    //     $product = $request->input('product_id');
    //     $quantity = $request->input('quantity');
    //     $price = $request->input('product_price');
    //     $total = $request->input('total');
    //     $status = $request->input('status')
    //     $time = time::where('time', = 'today');
    //     //dd($product);

    //     $store = new Orders;
    //     $store->order_date = $time;
    //     $store->user_id = $user;
    //     $store->product_id = $product;
    //     $store->qty = $quantity;
    //     $store->total = $price;
    //     $store->save();

    //     return redirect()->back()->with('success_message','Barang berhasil ditambah ke keranjang');
    // }
}
