<?php

namespace App\Http\Controllers\Backend;

use DB;
use View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Product;
use App\Product_image;
use App\Category_product;
use App\User;

class ProductController extends Controller
{
    //TAMPILAN PRODUCT PAGE
    public function index(){
        $products = Product::get();
        $categories = Category_product::all();
        $users = User::get();
        //dd($products->toArray);
        return view('pages.index')->with('products', $products)->with('categories', $categories)->with('users', $users);
    }

    public function destroy($id){
        $delete = Product::find($id);
        $delete->delete();
        return redirect('/');
    }


    //TAMPILAN CREATE PAGE
    public function show(){
        $categories = Category_product::all();
        return view('pages.create')->with('categories', $categories);
        
    }

    public function store(Request $request){
        $this->validate($request,[
            'product_name' => 'required',
            'product_price' => 'required|numeric',
            'category_name' => 'required',
            'img' => 'image|mimes:jpeg,png,jpg'
        ]);

        $name = $request->input('product_name');
        $price = $request->input('product_price');
        $category = $request->input('category_name');
                
        $store = new Product;
        $store->product_name = $name;
        $store->product_price = $price;
        $store->category_id = $category;
        $store->save();

        $product_id = $store->id;

        //dd($request->all());
                
         if($request->hasFile('img')){
            $image = $request->file('img');
            $image_len = count($image);
            for($i=0; $i<$image_len; $i++){
                $imageName = $image[$i]->getClientOriginalName();
                $storage = public_path('\upload');
                $image[$i]->move($storage, $imageName);
                $imageId = $product_id;
        
                $upload = new Product_image;
                $upload->product_id = $imageId;
                $upload->product_image = $imageName;
                $upload->save();
            }
        }
        return redirect('/')->withErrors('Data berhasil masuk!');
    }
        

    //TAMPILAN EDIT PAGE
    public function edit($id){

        $item = Product::with(['images'])->find($id);
        $id = $item->id;
        $images = $item->images;
        $categories = Category_product::all();

        //dd($item->toArray());
        return view('pages.edit')->with('item', $item)->with('categories', $categories)->with('images', $images);
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'product_name' => 'required',
            'product_price' => 'required|numeric',
            'category_name' => 'required',
            'product_image' => 'image|mimes:jpeg,png,jpg'
        ]);

        switch($request->input('action')){
            case 'update':
                $name = $request->get('product_name');
                $price = $request->get('product_price');
                $category = $request->get('category_name');
                
                $store = Product::find($id);
                if($store){
                    $store->product_name = $name;
                    $store->product_price = $price;
                    $store->category_id = $category;
                    $store->save();
                }
            
                $product_id = $store->id;
        
                //dd($request->all());
                
                if($request->hasFile('img')){
                    $image = $request->file('img');
                    $image_len = count($image);
                    for($i=0; $i<$image_len; $i++){
                        $imageName = $image[$i]->getClientOriginalName();
                        $storage = public_path('\upload');
                        $image[$i]->move($storage, $imageName);
                        $imageId = $product_id;
        
                        $upload = Product_image::find($id);
                        if($upload){
                            $upload->product_id = $request->$imageId;
                            $upload->product_image = $request->$imageName;
                            $upload->save();
                        }
                        
                    }
                }
                return redirect('/')->withErrors('Data berhasil update!');
            break;
            
        }
    }

    public function deleteImage($id){
        //$item = Product::with(['images'])->find($id);
        
        $item = Product::with(['images'])->find($id);
        $images = $item->images;

        dd($images);
        $images->delete();

        return redirect()->back();
    }


    //CATEGORY PAGE
    public function category(){
        return view('pages.category');
    }

    public function storeCategory(Request $request){
        
    }
}
