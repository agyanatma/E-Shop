<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function show(){
        $categories = Category_product::get();
        return view('pages.create')->with('categories', $categories);
        
    }

    public function store(Request $request){
        $this->validate($request,[
            'product_name' => 'required',
            'product_price' => 'required|numeric',
            'category_name' => 'required',
            'product_image' => 'image|mimes:jpeg,png,jpg'
        ]);
        
        $name = $request->input('product_name');
        $price = $request->input('product_price');
        $category = $request->input('category_name');
        
        $store = new Product;
        $store->product_name = $name;
        $store->product_price = $price;
        $store->category_id = $category;
        $store->save();

        //dd($store);

        return redirect()->back();
    }
}
