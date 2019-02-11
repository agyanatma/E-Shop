<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Product_image;
use App\Category_product;
use App\User;
use App\Orders;
use Auth;
class CategoryController extends Controller
{
    public function index(){
        $categories = Category_product::get();
        $images = ['categories' => [$categories]];
        return view('pages.frontend.index')->with('categories', $categories);
    }

    public function store(Request $request){
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
        return redirect('/category')->with('status','Data berhasil ditambah');
        
    }
    public function category(){
        
        return view('pages.frontend.category');
    }
}