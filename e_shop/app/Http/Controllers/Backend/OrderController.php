<?php
namespace App\Http\Controllers\Backend;
use Illuminate\Http\Request;
use App\Product;
use App\Product_image;
use App\Category_product;
use App\User;
use App\Orders;

class OrderController extends Controller
{
    public function index(){
        $orders = Orders::with('product', 'buyer')->get();
        $users = session()->get('user_session');
        //dd($total);
        return view('pages.admin.index_order')->with('orders', $orders)->with('users', $users);
    }

    public function destroy($id){
        $order = Orders::find($id);
        $order->delete();

        return redirect()->back()->with('status', 'Data berhasil dihapus');   
    }

    public function bayar(Request $request,$id){
        $order = Orders::find($id);
        if($order){
            $order->status = '2';
            $order->save();
        }

        return redirect()->back()->with('status','Barang sudah terbayar');
    }
    
//FRONT END=====================================================================================================================================
    public function cart(){
        $products = Product::with(['images'])->find($id);
        $users = session()->get('user_session');
        $buyer = $users->id;
        $orders = Orders::with('product','buyer')->where('user_id','=',$buyer);
        //dd($orders->toArray());

        return view('pages.checkout')->with('products', $products)->with('users', $users)->with('buyer', $buyer)->with('orders', $orders);
    }

    public function checkout(Request $request){
        $user = $request->input('user_id');
        $product = $request->input('product_id');
        $quantity = $request->input('quantity');
        $price = $request->input('product_price');
        $time = Carbon::today();
        //dd($product->toArray());

        $store = new Orders;
        $store->order_date = $time;
        $store->user_id = $user;
        $store->product_id = $product;
        $store->qty = $quantity;
        $store->total = $price;
        $store->save();

        return redirect()->back()->with('status','Barang berhasil ditambah ke keranjang');
    }
}