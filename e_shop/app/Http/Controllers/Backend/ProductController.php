<?php
namespace App\Http\Controllers\Backend;
use DB;
use View;
use Auth;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Product;
use App\Product_image;
use App\Category_product;
use App\User;
class ProductController extends Controller
{
    //ADMIN INDEX
    public function index(){
        $products = Product::with(['images'])->get();
        $categories = Category_product::all();
        $users = session()->get('user_session');
        //dd($products->toArray());
        return view('pages.admin.index_product')->with('products', $products)->with('categories', $categories)->with('users', $users);
    }

    public function dataTables(){
        $item = Product::with(['images'])->query();

        return Datatables::of($item)
            ->addColumn('action', function($item){
                return '<a href="admin/user/'.$item->id.'/change" class="btn btn-xs btn-warning">Admin</a><span>'.
                        '<a href="admin/user/'.$item->id.'/destroy" class="btn btn-xs btn-danger">Delete</a></span>';
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }


    //HAPUS PRODUK
    public function destroy($id){
        $item = Product::find($id);
        $product_id = $item->id;
        $image = Product_image::where('product_id', '=', $product_id)->get();
        //dd($delete->toArray());
        foreach($image as $file){
            if(file_exists((public_path('/upload/').$file->product_image))){
                if($file->product_image != 'image.png'){
                    unlink((public_path('/upload/').$file->product_image));
                }
                else{
    
                }
            }
            
        }
        Product_image::where('product_id', '=', $product_id)->delete();
        $item->delete();
        return redirect()->back()->with('status', 'Data berhasil dihapus');
        
    }
    //TAMPILAN CREATE PAGE
    public function show(){
        $categories = Category_product::all();
        $users = session()->get('user_session');
        return view('pages.admin.create_product')->with('categories', $categories)->with('users', $users);
    }
    public function storeDetail(Request $request){
        $this->validate($request,[
            'product_name' => 'required',
            'product_price' => 'required|numeric',
            'category_name' => 'required',
            'img[]' => 'image|mimes:jpeg,png,jpg'
        ]);
        $name = $request->input('product_name');
        $price = $request->input('product_price');
        $category = $request->input('category_name');
        $description = $request->input('description');
                
        $store = new Product;
        $store->product_name = $name;
        $store->product_price = $price;
        $store->category_id = $category;
        $store->description = $description;
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
        else{
            $upload = new Product_image;
            $imageId = $product_id;
            $upload->product_id = $imageId;
            $upload->product_image = 'image.png';
            $upload->save();
        }

        return redirect('/admin/product')->with('status', 'Data berhasil dimasukkan');
    }
        
    //TAMPILAN EDIT PAGE
    public function edit($id){
        $item = Product::with(['images'])->find($id);
        $id = $item->id;
        $images = $item->images;
        $categories = Category_product::all();
        $users = session()->get('user_session');
        //dd($item->toArray());
        return view('pages.admin.edit_product')->with('item', $item)->with('categories', $categories)->with('images', $images)->with('users', $users);
    }
    public function update(Request $request,$id){
        $this->validate($request,[
            'product_name' => 'required',
            'product_price' => 'required|numeric',
            'category_name' => 'required',
            //'img' => 'image|mimes:jpeg,png,jpg'
        ]);
        $name = $request->get('product_name');
        $price = $request->get('product_price');
        $category = $request->get('category_name');
        $description = $request->get('description');
        
        $store = Product::find($id);
        $store->product_name = $name;
        $store->product_price = $price;
        $store->category_id = $category;
        $store->description = $description;
        $store->save();
    
        $product_id = $store->id;
        //dd($product_id);
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
        return redirect('/admin/product')->with('status','Data berhasil update');
    }
    public function deleteImage($id){
        $image = Product_image::find($id);
        //dd($image->toArray());
        if(file_exists('upload/'.$file) && $file != 'image.png'){
            unlink('upload/'.$file);
        }
        $image->delete();
        return redirect()->back();
    }
}