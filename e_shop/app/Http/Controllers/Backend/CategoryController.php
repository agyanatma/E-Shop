<?php
namespace App\Http\Controllers\Backend;
use Illuminate\Http\Request;
use App\Category_product;
class CategoryController extends Controller
{
    
    public function index(){
        $categories = Category_product::get();
        $users = session()->get('user_session');
        return view('pages.admin.index_category')->with('categories', $categories)->with('users', $users);
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

        return redirect('/admin/category')->with('status','Data berhasil ditambah');
        
    }
    public function edit($id){
        $categories = Category_product::find($id);
        $images = ['categories' => [$categories]];
        $users = session()->get('user_session');
        //$images = $categories->category_image;
        //dd($images);
        return view('pages.admin.edit_category')->with('categories', $categories, $images)->with('users', $users);
    }
    public function update(Request $request,$id){
        $this->validate($request,[
            'category_name' => 'required',
            'category_image' => 'image|mimes:jpeg,png,jpg'
        ]);
        $category = $request->get('category_name');
        if($request->hasFile('img')){
            $file = Category_product::find($id);
            if($file->category_image != 'image.png'){
                unlink((public_path('/upload/').$file->category_image));
            }
            else{
            }
            $image = $request->file('img');
            $imageName = $image->getClientOriginalName();
            $storage = public_path('\upload');
            $image->move($storage, $imageName);
            $store = Category_product::find($id);
            $store->category_name = $category;
            $store->category_image = $imageName;
            $store->save();
        }

        return redirect('/admin/category')->with('status','Data berhasil diubah');
    }
    public function destroy($id){
        $category = Category_product::find($id);
        if(file_exists((public_path('/upload/').$category->category_image))){
            if($category->category_image != 'image.png'){
                unlink((public_path('/upload/').$category->category_image));
            }
            else{
            }
        }
        $category->delete();
        return redirect()->back()->with('status', 'Data berhasil dihapus');
        
    }


}
