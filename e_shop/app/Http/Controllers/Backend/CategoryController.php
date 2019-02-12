<?php
namespace App\Http\Controllers\Backend;
use Illuminate\Http\Request;
use App\Category_product;
use Auth;

class CategoryController extends Controller
{
    
    public function index(){
        $categories = Category_product::get();
        //dd($categories->toArray());
        return view('pages.admin.index_category')->with('categories', $categories);
    }
    public function new(){
        return view('pages.admin.create_category');
    }
    public function store(Request $request){
        $this->validate($request,[
            'category_name' => 'required',
            'img' => 'image|mimes:jpeg,png,jpg'
        ]);

        $item = new Category_product;
        $item->category_name = $request->category_name;

        if($request->hasFile('img')){
            $image = $request->file('img');
            $imageName = $image->getClientOriginalName();
            $image->move('upload', $imageName);
            $item->category_image = $imageName;
            $item->save();
        }
        else{
            $item->category_image = 'image.png';
            $item->save();
        }
        $new->save();

        return redirect('/admin/category')->with('status','Data berhasil ditambah');
        
    }
    public function edit($id){
        $categories = Category_product::find($id);
        $id = $categories->id;
        return view('pages.admin.edit_category')->with('categories', $categories);
    }
    public function update(Request $request,$id){
        $this->validate($request,[
            'category_name' => 'required',
            'img' => 'image|mimes:jpeg,png,jpg'
        ]);

        $item = Category_product::find($id);
        $item->category_name = $request->category_name;

        if($request->hasFile('img')){    ;
            $file = $item->category_image;
            if(file_exists('upload/'.$file) && $file !='image.png'){
                unlink('upload/'.$file);
            }
            $image = $request->file('img');
            $imageName = $image->getClientOriginalName();
            $image->move('upload', $imageName);
            $item->category_image = $imageName;
        }
        $item->save();

        return redirect('/admin/category')->with('status','Data berhasil diubah');
    }
    public function destroy($id){
        $category = Category_product::find($id);
        $file = $category->category_image;
        if(file_exists('upload/'.$file) && $file !='image.png'){
            unlink('upload/'.$file);
        }
        $category->delete();
        return redirect()->back()->with('status', 'Data berhasil dihapus');
        
    }
}
