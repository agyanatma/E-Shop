<?php

namespace App\Http\Controllers\Frontend;

use DB;
use View;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Product;
use App\Product_image;
use App\Category_product;
use App\User;
use App\Orders;
use App\Wishlist;
class SortController extends Controller
{
    public function sortbycategory($id){
       
        $products = Product::with(['images'])->where([
            'category_id' => $id,
        ])->paginate(24);
        $categories = Category_product::take(5)->get();
        $users = Auth::user();
        if (Auth::user() && $orders = 1){
            $users = Auth::user();
            $buyer = Auth::user()->id;
            $products = Product::with(['images'])->where([
                'category_id' => $id,
            ])->paginate(24);
            
            $categories = Category_product::take(5)->get(
            );
            //dd($categories);
            $orders = Orders::with('product','buyer')->where('user_id','=',$buyer)->get();
            $totalorder = Orders::with('product','buyer')->where([
                'user_id' => $buyer,
                'status' => 0,
            ])->count();

            return view('pages.frontend.sortby')->with('products', $products)
            ->with('users', $users)->with('categories', $categories)
            ->with('buyer', $buyer)->with('orders', $orders)
            ->with('totalorder', $totalorder);
        }
        return view('pages.frontend.sortby')->with('products', $products)->with('categories', $categories)
        ->with('users', $users);
        
    }

    
    public function lainlain(){
        $products = Product::with(['images'])->paginate(24);
        $categories = Category_product::get();
        $users = Auth::User();
        $orders = Orders::all();
        if (Auth::user() && $orders = 1){
            $user = Auth::user();
            $buyer = Auth::user()->id;
            $orders = Orders::with('product','buyer')->where('user_id','=',$buyer)->get();
            $totalorder = Orders::with('product','buyer')->where([
                'user_id' => $buyer,
                'status' => 0,
            ])->count();
            $qty = Orders::with('product','buyer')->where('user_id','=',$buyer )->where('status', '=', '0');
            $totalqty = Orders::with('product','buyer')->where('user_id','=',$buyer)->where('status', '=', '0')->sum('qty');
            $total = Orders::with('product','buyer')->where('user_id','=',$buyer)->where('status', '=', '0')->sum('total');
            //dd($totalqty);
            return view('pages.frontend.lainlain')->with('categories', $categories)
            ->with('products', $products)->with('user', $user)->with('users', $users)
            ->with('buyer', $buyer)->with('orders', $orders)->with('category', $categories)
            ->with('total', $total)->with('totalqty', $totalqty)->with('qty', $qty)
            ->with('totalorder', $totalorder);
        }
        else{
            return view('pages.frontend.lainlain')->with('products', $products)->with('categories', $categories)->with('users', $users);
        }
    }
}
