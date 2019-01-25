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

class SortController extends Controller
{
    public function sortheadset(){
        $products = Product::with(['images'])->where('category_id', '=', 1)->get();
        $categories = Category_product::all();
        $users = session()->get('user_session');
        //dd($products);
        return view('pages.frontend.sortheadset')->with('products', $products)->with('categories', $categories)->with('users', $users);
    }

    public function sortkeyboard(){
        $products = Product::with(['images'])->where('category_id', '=', 2)->get();
        $categories = Category_product::all();
        $users = session()->get('user_session');
        //dd($products);
        return view('pages.frontend.sortkeyboard')->with('products', $products)->with('categories', $categories)->with('users', $users);
    }

    public function sortleptop(){
        $products = Product::with(['images'])->where('category_id', '=', 3)->get();
        $categories = Category_product::all();
        $users = session()->get('user_session');
        //dd($products);
        return view('pages.frontend.sortleptop')->with('products', $products)->with('categories', $categories)->with('users', $users);
    }

    public function sortmonitor(){
        $products = Product::with(['images'])->where('category_id', '=', 4)->get();
        $categories = Category_product::all();
        $users = session()->get('user_session');
        //dd($products);
        return view('pages.frontend.sortmonitor')->with('products', $products)->with('categories', $categories)->with('users', $users);
    }

    public function sortprocessor(){
        $products = Product::with(['images'])->where('category_id', '=', 9)->get();
        $categories = Category_product::all();
        $users = session()->get('user_session');
        //dd($products);
        return view('pages.frontend.sortprocessor')->with('products', $products)->with('categories', $categories)->with('users', $users);
    }
}
