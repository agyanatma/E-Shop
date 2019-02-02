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
        $qty = Orders::with('product','buyer')->where('user_id','=',$buyer )->where('status', '=', '0');
        $total = Orders::with('product','buyer')->where('user_id','=',$buyer )->where('status', '=', '0')->sum('total');
        $totalqty = Orders::with('product','buyer')->where('user_id','=',$buyer)->where('status', '=', '0')->sum('qty');
        //dd($total);
        return view('pages.frontend.cart')->with('products', $products)->with('users', $users)->with('buyer', $buyer)->with('orders', $orders)->with('category', $categories)->with('total', $total)->with('totalqty', $totalqty)->with('qty', $qty);
    }

    public function deleteCart($id){
        $order = Orders::find($id);
        $order->delete();
        return redirect()->back()->with('status', 'Data berhasil dihapus');   
    }
    
    public function checkout(Request $request, $id){
        $products = Product::find($id);
        $cart = session()->get('cart');
        if(!$cart) {
        $cart = [
            $user = $request->input('user_id'),
            $product = $request->input('product_id'),
            $quantity = $request->input('quantity'),
            $price = $request->input('product_price'),
            $time = Carbon::today(),

            $store = new Orders,
            $store->order_date = $time,
            $store->user_id = $user,
            $store->product_id = $product,
            $store->qty = $quantity,
            $store->total = $quantity * $price,
            $store->save(),
            $cart = session()->get('cart'),
        ];

            session()->put('cart', $cart);
 
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        $cart[$id] = [
            $user = $request->input('user_id'),
            $product = $request->input('product_id'),
            $quantity = $request->input('quantity'),
            $price = $request->input('product_price'),
            $time = Carbon::today(),

            $store = new Orders,
            $store->order_date = $time,
            $store->user_id = $user,
            $store->product_id = $product,
            $store->qty = $quantity,
            $store->total = $quantity * $price,
            $store->save(),
            $cart = session()->get('cart'),
        ];
 
        session()->put('cart', $cart);
 
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');
 
            $cart[$request->id]["quantity"] = $request->quantity;
 
            session()->put('cart', $cart);
 
            session()->flash('success', 'Cart updated successfully');
        }
    }
 
    public function remove(Request $request)
    {
        if($request->id) {
 
            $cart = session()->get('cart');
 
            if(isset($cart[$request->id])) {
 
                unset($cart[$request->id]);
 
                session()->put('cart', $cart);
            }
 
            session()->flash('success', 'Product removed successfully');
        }
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

    public function langsungbayar(Request $request){
        $buyer = Auth::user()->id;
        $orders = Orders::with('product','buyer')->where('user_id','=',$buyer)->get();

        $user = $request->input('user_id');
        $product = $request->input('product_id');
        $quantity = $request->input('quantity', '1');
        $price = $request->input('product_price');
        $time = Carbon::today();
        //dd($request->all());

        $store = new Orders;
        $store->order_date = $time;
        $store->user_id = $user;
        $store->product_id = $product;
        $store->qty = $quantity;
        $store->total = $quantity * $price;
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
        $total = Orders::with('product','buyer')->where('user_id','=',$buyer)->where('status', '=', '0')->sum('total');
        $totalqty = Orders::with('product','buyer')->where('user_id','=',$buyer)->where('status', '=', '0')->sum('qty');
        
        return view('pages.frontend.checkoutgan')->with('products', $products)->with('users', $users)->with('buyer', $buyer)->with('orders', $orders)->with('category', $categories)->with('total', $total)->with('totalqty', $totalqty);
    }

   
}
