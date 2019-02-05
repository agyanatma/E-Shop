<?php

namespace App\Http\Controllers\Frontend;

use DB;
use View;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

use App\Product;
use App\Product_image;
use App\Category_product;
use App\Category_image;
use App\User;
use App\Cart;
use App\Orders;
use Session;


class ProductController extends Controller
{
    

    public function searchcontent(){
        $searchkey = \Request::get('title');
        $products = Product::where('product_name', 'like', '%' .$searchkey. '%')->orderBy ('id')->get();
        $categories = Category_product::all();
        $users = session()->get('user_session');
        //dd($products);
        return view('pages.frontend.searchcontent')->with('products', $products)->with('categories', $categories)->with('users', $users);
    }

    public function shop(){
        $title = 'SHOP';
        //return view ('pages.index', compact ('title'));
        return view ('pages.frontend.shop')->with ('title', $title);
    }

    // public function detailproduct($id){
    //     //$products = Product::find($id);
        
    //     $products = Product::with(['images'])->where('id', $id)->get();
    //     $categories = Category_product::all();
    //     $users = session()->get('user_session');
    //     //dd($products->find($id)->toArray());
    //     return view('pages.frontend.detailproduct')->with('products', $products)->with('categories', $categories)->with('users', $users);

    // }
    public function detailproduct($id){
        if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
            // Ignores notices and reports all other kinds... and warnings
            error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
            // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
        }
        $products = Product::with(['images'])->find($id);
        $id = $products->id;
        $images = Product_image::where('product_id','=',$id)->get();
        $categories = Category_product::all();
        $users = session()->get('user_session');
        
        if (Auth::user() && $orders = 1){
            $user = Auth::user();
            $buyer = Auth::user()->id;
            $orders = Orders::with('product','buyer')->where('user_id','=',$buyer)->get();
            $qty = Orders::with('product','buyer')->where('user_id','=',$buyer )->where('status', '=', '0');
            $totalqty = Orders::with('product','buyer')->where('user_id','=',$buyer)->where('status', '=', '0')->sum('qty');
            $total = Orders::with('product','buyer')->where('user_id','=',$buyer )->where('status', '=', '0')->sum('total');
            return view('pages.frontend.detailproduct')->with('categories', $categories)->with('products', $products)->with('user', $user)->with('users', $users)->with('buyer', $buyer)->with('orders', $orders)->with('category', $categories)->with('total', $total)->with('totalqty', $totalqty)->with('qty', $qty);
        }
       
        //dd($orders->toArray());
        return view('pages.frontend.detailproduct')->with('products', $products)->with('categories', $categories)->with('users', $users)->with('images', $images)->with('orders', $orders);
    }
    
    public function tambahproduct(){
        $title = 'TAMBAH PRODUCT';
        //return view ('pages.index', compact ('title'));
        return view ('pages.frontend.tambahproduct')->with ('title', $title);
    }

    public function user(){
        $products = Product::with(['images'])->paginate(24);
        $categories = Category_product::get();
        $users = session()->get('user_session');
        $orders = Orders::all();
        if (Auth::user() && $orders = 1){
            $user = Auth::user();
            $buyer = Auth::user()->id;
            $orders = Orders::with('product','buyer')->where('user_id','=',$buyer)->get();
            $qty = Orders::with('product','buyer')->where('user_id','=',$buyer )->where('status', '=', '0');
            $totalqty = Orders::with('product','buyer')->where('user_id','=',$buyer)->where('status', '=', '0')->sum('qty');
            $total = Orders::with('product','buyer')->where('user_id','=',$buyer )->where('status', '=', '0')->sum('total');
            //dd($totalqty);
            return view('pages.frontend.index')->with('categories', $categories)->with('products', $products)->with('user', $user)->with('users', $users)->with('buyer', $buyer)->with('orders', $orders)->with('category', $categories)->with('total', $total)->with('totalqty', $totalqty)->with('qty', $qty);
        }
        else{
            return view('pages.frontend.index')->with('products', $products)->with('categories', $categories)->with('users', $users);
        }
        
    
    }

    public function guest(){
        $products = Product::with(['images'])->paginate(24);
        
        $users = session()->get('user_session');
        $categories = Category_product::with('images')->get();
        //$user = Auth::user();
        //dd($user);
        return view('pages.frontend.index')->with('products', $products)->with('categories', $categories)->with('users', $users);
    }
    

    public function getAddToCart(Request $request, $id){
        $products = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') :null;
        $cart = new Cart($oldCart);
        $cart->add($products, $products->id);
        $users = session()->get('user_session');
        $request->session()->put('cart', $cart);
        //dd($request->session()->get('cart'));
        //dd($product['qty']);
        return redirect()->back()->with('success_message','Barang berhasil ditambah ke keranjang');
    }

    public function getCart(){
        $products = Product::with(['images'])->get();
        //$orders = Orders::with('product','buyer')->where('user_id','=',$buyer);
        $categories = Category_product::all();
        $users = session()->get('user_session');
        $cart = Product::with(['images'])->get();
        if (!Session::has('cart')){
            return view ('pages.frontend.shopping-cart', ['products'=> null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart ($oldCart);
        
        return view('pages.frontend.shopping-cart', ['products' => $cart->items, 'totalPrice'=>$cart->totalPrice, 'users'=>$users, 'products'=>$products, 'categories'=> $categories, ]) ;
    }

    public function getCheckout(){
        $users = session()->get('user_session');
        if (!Session::get('cart')){
            return view('pages.frontend.shopping-cart');
        }
         $oldCart = Session::get('cart');
         $cart = new Cart ($oldCart);
         $total = $cart -> totalPrice;
         return view ('pages.frontend.checkoutCart', ['total' => $total, 'users'=>$users]);   
    }


}