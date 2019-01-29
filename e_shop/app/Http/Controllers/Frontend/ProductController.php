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
    
    public function searchcontent(){
        $searchkey = \Request::get('title');
        $products = Product::where('product_name', 'like', '%' .$searchkey. '%')->orderBy ('id')->get();
        $categories = Category_product::all();
        $users = User::get();
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
        $products = Product::with(['images'])->find($id);
        $id = $products->id;
        $images = Product_image::where('product_id','=',$id)->get();
        $categories = Category_product::all();
        $users = session()->get('user_session');
        //dd($images->toArray());
        return view('pages.frontend.detailproduct')->with('products', $products)->with('categories', $categories)->with('users', $users)->with('images', $images);
    }
    
    public function tambahproduct(){
        $title = 'TAMBAH PRODUCT';
        //return view ('pages.index', compact ('title'));
        return view ('pages.frontend.tambahproduct')->with ('title', $title);
    }

    public function guest(){
        $products = Product::with(['images'])->get();
        $categories = Category_product::all();
        $users = session()->get('user_session');
        //$user = Auth::user();
        //dd($user);
        return view('pages.frontend.index')->with('products', $products)->with('categories', $categories)->with('users', $users);
    }
    


}