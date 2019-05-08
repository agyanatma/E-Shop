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
use App\Order_product;
use App\Order_detail;
use App\Wishlist;
class SortController extends Controller
{
    public function sortbycategory($id){
        $users = Auth::user();
        $products = Product::with(['images'])->where([
            'category_id' => $id,
        ])->paginate(24);
        $categories = Category_product::take(5)->get();
        // dd($categories->toArray());
            if (Auth::user() && $orders = 1){
        $buyer = Auth::user()->id;
        $orders = Order_product::with('product','buyer')->where('user_id','=',$buyer)->get();
        $totalorder = Order_product::with('product','buyer')->where([
            'user_id' => $buyer,
        ])->count();
            return view('pages.frontend.sortby')
            ->with('products', $products)->with('users', $users)
            ->with('buyer', $buyer)->with('orders', $orders)->with('categories', $categories)
            ->with('totalorder', $totalorder);
        }
        else{
            return view('pages.frontend.sortby')
            ->with('products', $products)->with('users', $users)
            ->with('categories', $categories);
        }
    }
    
    public function lainlain(){
        $products = Product::with(['images'])->paginate(24);
        $categories = Category_product::get();
        $users = Auth::User();
            if (Auth::user() && $orders = 1){
        $buyer = Auth::user()->id;
        $orders = Order_product::with('product','buyer')->where('user_id','=',$buyer)->get();
        $totalorder = Order_product::with('product','buyer')->where([
            'user_id' => $buyer,
        ])->count();
            return view('pages.frontend.lainlain')->with('categories', $categories)
            ->with('products', $products)->with('users', $users)
            ->with('buyer', $buyer)->with('orders', $orders)->with('category', $categories)
            ->with('totalorder', $totalorder);
        }
        else{
            return view('pages.frontend.lainlain')
            ->with('products', $products)->with('users', $users)
            ->with('categories', $categories);
        }
    }
}