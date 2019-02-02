<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Category_product;
use App\Category_image;

class CategoryController extends Controller
{
    
    public function index(){
        $categories = Category_product::with('images')->get();
        //dd($categories->toArray());
        return view('pages.admin.index_category')->with('categories', $categories);
    }

    public function new(){
        $users = session()->get('user_session');
        return view('pages.admin.create_category')->with('users', $users);
    }

    public function store(Request $request){
        $this->validate($request,[
            'category_name' => 'required',
            'img' => 'image|mimes:jpeg,png,jpg'
        ]);

        $item = new Category_product;
        $item->category_name = $request->category_name;
        $item->save();

        $category_id = $item->id;

        if($request->hasFile('img')){
            $image = $request->file('img');
            $imageName = $image->getClientOriginalName();
            $image->move('upload', $imageName);

            $upload = new Category_image;
            $upload->category_id = $category_id;
            $upload->category_image = $imageName;
            $upload->save();
        }
        else{
            $upload = new Category_image;
            $upload->category_id = $category_id;
            $upload->category_image = 'image.png';
            $upload->save();
        }

        return redirect('admin/category')->with('status','Data berhasil ditambah');
        
    }

    public function edit($id){
        $categories = Category_product::with(['images'])->find($id);
        $id = $categories->id;
        //$images = $categories->category_image;
        //dd($images);
        return view('pages.admin.edit_category')->with('categories', $categories);
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'category_name' => 'required',
            'img' => 'image|mimes:jpeg,png,jpg'
        ]);

        $item = Category_product::find($id);
        $item->category_name = $request->category_name;
        $item->save();
        $category_id = $item->id;

        if($request->hasFile('img')){
            $images = Category_image::where('category_id','=',$category_id)->first()    ;
            $file = $images->category_image;
            if(file_exists('upload/'.$file) && $file !='image.png'){
                unlink('upload/'.$file);
            }
            $images->delete();
            $image = $request->file('img');
            $imageName = $image->getClientOriginalName();
            $image->move('upload', $imageName);
            
            $upload = new Category_image;
            $upload->category_id = $category_id;
            $upload->category_image = $imageName;
            $upload->save();
        }

        return redirect('admin/category')->with('status','Data berhasil diubah');
    }

    public function destroy($id){
        $category = Category_product::find($id);
        $category_id = $category->id;
        $image = Category_image::where('category_id', '=', $category_id)->first();
        $file = $image->category_image;
        if(file_exists('upload/'.$file) && $file !='image.png'){
            unlink('upload/'.$file);
        }
        $image->delete();
        $category->delete();

        return redirect('admin/category')->with('status', 'Data berhasil dihapus');
        
    }

    public function deleteImage($id){
        $image = Category_image::find($id)->first();
        $file = $image->category_image;
        //dd($image->toArray());
        if(file_exists('upload/'.$file)){
            unlink('upload/'.$file);
        }
        $image->delete();

        return redirect()->back();
    }
}
