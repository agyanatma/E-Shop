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
    public function sortheadphone(){
        $products = Product::with(['images'])->where('category_id', '=', 11)->paginate(24);
        $categories = Category_product::all();
        $users = session()->get('user_session');
        //dd($products);
        return view('pages.frontend.sortlist.sortheadphone')->with('products', $products)->with('categories', $categories)->with('users', $users);
    }

    public function sortkeyboard(){
        $products = Product::with(['images'])->where('category_id', '=', 3)->paginate(24);
        $categories = Category_product::all();
        $users = session()->get('user_session');
        //dd($products);
        return view('pages.frontend.sortlist.sortkeyboard')->with('products', $products)->with('categories', $categories)->with('users', $users);
    }

    public function sortleptop(){
        $products = Product::with(['images'])->where('category_id', '=', 12)->paginate(24);
        $categories = Category_product::all();
        $users = session()->get('user_session');
        //dd($products);
        return view('pages.frontend.sortlist.sortleptop')->with('products', $products)->with('categories', $categories)->with('users', $users);
    }

    public function sortmonitor(){
        $products = Product::with(['images'])->where('category_id', '=', 1)->paginate(24);
        $categories = Category_product::all();
        $users = session()->get('user_session');
        //dd($products);
        return view('pages.frontend.sortlist.sortmonitor')->with('products', $products)->with('categories', $categories)->with('users', $users);
    }

    public function sortprocessor(){
        $products = Product::with(['images'])->where('category_id', '=', 4)->paginate(24);
        $categories = Category_product::all();
        $users = session()->get('user_session');
        //dd($products);
        return view('pages.frontend.sortlist.sortprocessor')->with('products', $products)->with('categories', $categories)->with('users', $users);
    }

    public function sortbattery(){
        $products = Product::with(['images'])->where('category_id', '=', 8)->paginate(24);
        $categories = Category_product::all();
        $users = session()->get('user_session');
        //dd($products);
        return view('pages.frontend.sortlist.sortbattery')->with('products', $products)->with('categories', $categories)->with('users', $users);
    }

    public function sortcpu(){
        $products = Product::with(['images'])->where('category_id', '=', 5)->paginate(24);
        $categories = Category_product::all();
        $users = session()->get('user_session');
        //dd($products);
        return view('pages.frontend.sortlist.sortcpu')->with('products', $products)->with('categories', $categories)->with('users', $users);
    }

    public function sorthdmi(){
        $products = Product::with(['images'])->where('category_id', '=', 6)->paginate(24);
        $categories = Category_product::all();
        $users = session()->get('user_session');
        //dd($products);
        return view('pages.frontend.sortlist.sorthdmi')->with('products', $products)->with('categories', $categories)->with('users', $users);
    }
    
    public function sortmotherboard(){
        $products = Product::with(['images'])->where('category_id', '=', 9)->paginate(24);
        $categories = Category_product::all();
        $users = session()->get('user_session');
        //dd($products);
        return view('pages.frontend.sortlist.sortmotherboard')->with('products', $products)->with('categories', $categories)->with('users', $users);
    }
    
    public function sortmouse(){
        $products = Product::with(['images'])->where('category_id', '=', 2)->paginate(24);
        $categories = Category_product::all();
        $users = session()->get('user_session');
        //dd($products);
        return view('pages.frontend.sortlist.sortmouse')->with('products', $products)->with('categories', $categories)->with('users', $users);
    }

    public function sortpowercable(){
        $products = Product::with(['images'])->where('category_id', '=', 7)->paginate(24);
        $categories = Category_product::all();
        $users = session()->get('user_session');
        //dd($products);
        return view('pages.frontend.sortlist.sortpowercable')->with('products', $products)->with('categories', $categories)->with('users', $users);
    }    
    
    public function sortprinter(){
        $products = Product::with(['images'])->where('category_id', '=', 10)->paginate(24);
        $categories = Category_product::all();
        $users = session()->get('user_session');
        //dd($products);
        return view('pages.frontend.sortlist.sortprinter')->with('products', $products)->with('categories', $categories)->with('users', $users);
    }

    public function lainlain(){
        $products = Product::with(['images'])->paginate(24);
        $categories = Category_product::all();
        $users = session()->get('user_session');
        //dd($products);
        return view('pages.frontend.sortlist.lainlain')->with('products', $products)->with('categories', $categories)->with('users', $users);
    }
}
