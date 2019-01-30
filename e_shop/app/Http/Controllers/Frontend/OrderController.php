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
        $products = Product::with(['images'])->get();
        $users = session()->get('user_session');
        $buyer = Auth::user()->id;
        $orders = Orders::with('product','buyer')->where('user_id','=',$buyer)->get();
        //dd($orders->toArray());
        $categories = Category_product::all();
        $total = Orders::with('product','buyer')->where('user_id','=',$buyer)->sum('total');
        $qty = Orders::with('product','buyer')->where('user_id','=',$buyer)->sum('qty');
        $totalharga = $total * $qty ;
        //dd($totalharga);
        return view('pages.frontend.cart')->with('products', $products)->with('users', $users)->with('buyer', $buyer)->with('orders', $orders)->with('category', $categories)->with('total', $total)->with('qty', $qty)->with('totalharga', $totalharga);
    }

    public function deleteCart($id){
        $order = Orders::find($id);
        $order->delete();
        return redirect()->back()->with('status', 'Data berhasil dihapus');   
    }
    
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

    public function getcheckoutgan(){
        $products = Product::with(['images'])->get();
        $users = session()->get('user_session');
        $buyer = Auth::user()->id;
        $orders = Orders::with('product','buyer')->where('user_id','=',$buyer)->get();
        //dd($orders->toArray());
        $categories = Category_product::all();
        $total = Orders::with('product','buyer')->where('user_id','=',$buyer)->sum('total');
        $qty = Orders::with('product','buyer')->where('user_id','=',$buyer)->sum('qty');
        $totalharga = $total * $qty;
        return view('pages.frontend.checkoutgan')->with('products', $products)->with('users', $users)->with('buyer', $buyer)->with('orders', $orders)->with('category', $categories)->with('total', $total)->with('qty', $qty)->with('totalharga', $totalharga);
    }

    public function getCartadd(){
        Cart::add([
            ['id' => '293ad', 'name' => 'Product 1', 'qty' => 1, 'price' => 10.00],
            ['id' => '4832k', 'name' => 'Product 2', 'qty' => 1, 'price' => 10.00,]
          ]);
    }

    public function bayar(Request $request, $id){
        $orders = Orders::find($id);
        dd($orders->toArray());
        if($order){
            $order->status = '1';
            $order->save();
        }

        return redirect()->back()->with('status','Barang sudah terbayar');
    }
    // public function bayar(Request $request){
    //     $user = $request->input('user_id');
    //     $product = $request->input('product_id');
    //     $quantity = $request->input('quantity');
    //     $price = $request->input('product_price');
    //     $total = $request->input('total');
    //     $status = $request->input('status');
    //     $time = Carbon::where('time', = 'today');
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
