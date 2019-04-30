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

use App\Orders;
use App\Order_product;
use App\Order_detail;
use Session;
use App\Wishlist;

class ProductController extends Controller
{
    public function searchcontent(){
        $searchkey = \Request::get('title');
        $products = Product::where('product_name', 'like', '%' .$searchkey. '%')->orderBy ('id')->paginate(24);
        $categories = Category_product::take(5)->get();
        $users = Auth::User();
        if (Auth::user() && $orders = 1){
        $buyer = Auth::user()->id;
        $orders = Order_product::with('product','buyer')->where('user_id','=',$buyer)->get();
        $totalorder = Order_product::with('product','buyer')->where([
            'user_id' => $buyer,
        ])->count();

        return view('pages.frontend.searchcontent')->with('categories', $categories)->with('users', $users)
            ->with('buyer', $buyer)->with('orders', $orders)
            ->with('products', $products)->with('totalorder' , $totalorder)
            ->with('status','Product has been successfully added to cart');
        }
        else{
            return view('pages.frontend.searchcontent')
            ->with('products', $products)->with('users', $users)
            ->with('categories', $categories);
        }
    }

    public function shop(){
        $title = 'SHOP';
        //return view ('pages.index', compact ('title'));
        return view ('pages.frontend.shop')->with ('title', $title);
    }

    public function detailproduct($id){
        
        $products = Product::with(['images'])->find($id);
        $images = Product_image::where('product_id','=',$id)->get();
        $users = Auth::User();
        $productrandom = Product::inRandomOrder()->with(['images'])->take(6)->get();
        
        //dd($productrandom->toArray());
        if (Auth::user() && $orders = 1){
            $user = Auth::user();
            $buyer = Auth::user()->id;
            $qty = Order_product::with('product','buyer')->where([
                'user_id' => $buyer,
                ])->get();
            $orders = Order_product::with('product','buyer')->where('user_id','=',$buyer)->get();
            $totalorder = Order_product::with('product','buyer')->where([
                'user_id' => $buyer,
            ])->count();
            return view('pages.frontend.detailproduct')
            ->with('products', $products)->with('user', $user)->with('users', $users)
            ->with('buyer', $buyer)->with('orders', $orders)
            ->with('totalorder', $totalorder)->with('productrandom', $productrandom)
            ->with('images', $images);
        }
        return view('pages.frontend.detailproduct')->with('products', $products)
        ->with('users', $users)->with('images', $images)->with('productrandom', $productrandom);
      
        //dd($orders->toArray());
        
    }
    
    public function tambahproduct(){
        $title = 'TAMBAH PRODUCT';
        //return view ('pages.index', compact ('title'));
        return view ('pages.frontend.tambahproduct')->with ('title', $title);
    }

    public function user(){
        $users = Auth::user();
        $products = Product::inRandomOrder()->with(['images'])->paginate(24);
        //$categories = Category_product::with(['images'])->find($id);
        $categories = Category_product::take(5)->get();
        if (Auth::user() && $orders = 1){
            $users = Auth::user();
            $buyer = Auth::user()->id;
            $orders = Order_product::with('product','buyer')->where('user_id','=',$buyer)->get();
            $totalorder = Order_product::with('product','buyer')->where([
                'user_id' => $buyer,
                
            ])->count();
            
            //dd($totalqty);
            return view('pages.frontend.index')
            ->with('products', $products)->with('users', $users)
            ->with('buyer', $buyer)->with('orders', $orders)->with('categories', $categories)
            ->with('totalorder', $totalorder);
        }
        else{
            return view('pages.frontend.index')
            ->with('products', $products)->with('users', $users)
           ->with('categories', $categories);
        }
        
    }


}