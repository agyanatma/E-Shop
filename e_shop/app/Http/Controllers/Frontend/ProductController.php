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

class ProductController extends Controller
{
    public function index(){
        $products = Product::with(['images'])->get();
        $categories = Category_product::all();
        $users = User::get();
        //dd($products);
        return view('pages.frontend.index')->with('products', $products)->with('categories', $categories)->with('users', $users);
    }

    public function shop(){
        $title = 'SHOP';
        //return view ('pages.index', compact ('title'));
        return view ('pages.frontend.shop')->with ('title', $title);
    }

    public function detailproduct(){
        $title = 'blog';
        //return view ('pages.index', compact ('title'));
        return view ('pages.frontend.detailproduct')->with ('title', $title);
    }

    public function tambahproduct(){
        $title = 'TAMBAH PRODUCT';
        //return view ('pages.index', compact ('title'));
        return view ('pages.frontend.tambahproduct')->with ('title', $title);
    }

    


}