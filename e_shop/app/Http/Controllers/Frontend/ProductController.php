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

    public function storeCategory(Request $request){
        $this->validate($request,[
            'category_name' => 'required',
            'img' => 'image|mimes:jpeg,png,jpg'
        ]);

        $new = new Category_product;
        $new->category_name = $request->category_name;

        if($request->hasFile('img')){
            $image = $request->file('img');
            $imageName = $image->getClientOriginalName();
            $storage = public_path('\upload');
            $image->move($storage, $imageName);
            $new->category_image = $imageName;
        }
        else{
            $new->category_image = 'image.png';
        }
        $new->save();

        return redirect('/product/new');
        
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
    
    public function listproduct(){
        $products = Product::with(['images'])->get();
        $categories = Category_product::all();
        $users = User::get();
        //return view ('pages.index', compact ('title'));
        return view('pages.frontend.listproduct')->with('products', $products)->with('categories', $categories)->with('users', $users);
    }

    public function tambahproduct(){
        $title = 'TAMBAH PRODUCT';
        //return view ('pages.index', compact ('title'));
        return view ('pages.frontend.tambahproduct')->with ('title', $title);
    }

    /*public function storeCategory($id){
        $item = Category_image::with(['images'])->find($id);
        $id = $item->id;
        $images = $item->images;
        $categories = Category_product::all();
        dd($item->toArray());

        return view('pages.detail');

    }*/
}