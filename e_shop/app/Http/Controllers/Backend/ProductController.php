<?php
namespace App\Http\Controllers\Backend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Product;
use App\Product_image;
use App\Category_product;
use App\User;
use DataTables;

class ProductController extends Controller
{
    //ADMIN INDEX
    public function index(){
        $products = Product::with(['images'])->get();
        $categories = Category_product::all();
        //dd($products->toArray());
        return view('pages.admin.index_product')->with('products', $products)->with('categories', $categories);
    }

    public function show($id){
        $products = Product::with(['categories','images'])->find($id);
        //$id = $products->id;
        $images = $products->images;
        //dd($products->toArray());
        return view('pages.admin.view_product')->with('products', $products)->with('images', $images);
    }

    public function dataTables(){
        $item = Product::with(['categories','images'])->get();

        return Datatables::of($item)
            ->addIndexColumn()
            ->editColumn('product_price', function ($item) {
                return 'Rp '.number_format($item->product_price, 0);
            })
            ->addColumn('category_name', function($item){
                return $item->categories->category_name;
            })
            ->addColumn('images', function($item){
                return '<img class="img" style="object-fit:cover" width="50px" height="50px" src="'.$item->images[0]->product_image.'">';
            })
            ->addColumn('action', function($item){
                return  '<a href="'.route('show.product', $item->id).'" class="btn btn-sm btn-info" style="margin-right:7px"><i class="fas fa-eye"></i></a>'.
                        '<a href="'.route('edit.product', $item->id).'" class="btn btn-sm btn-info" style="margin-right:7px"><i class="fas fa-edit"></i></a>'.
                        '<a href="'.route('destroy.product', $item->id).'" class="btn btn-sm btn-info"><i class="fas fa-trash-alt"></i></a>';
            })
            ->rawColumns(['images','action'])
            ->make(true);
    }


    public function destroy($id){
        $item = Product::find($id);
        $product_id = $item->id;
        $image = Product_image::where('product_id', $product_id)->get();
        //dd($delete->toArray());
        foreach($image as $file){
            if(file_exists('upload'.$file->product_image)){
                if($file->product_image != 'image.png'){
                    unlink('upload'.$file->product_image);
                }
            }
        }
        Product_image::where('product_id', $product_id)->delete();
        $item->delete();
        return redirect()->back()->with('status', 'Data berhasil dihapus');
        
    }
    public function create(){
        $categories = Category_product::all();
        return view('pages.admin.create_product')->with('categories', $categories);
    }
    public function store(Request $request){
        $this->validate($request,[
            'product_name' => 'required',
            'product_price' => 'required|numeric',
            'category_name' => 'required',
            'img.*' => 'image|mimes:jpeg,png,jpg',
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
                $image[$i]->move('upload', $imageName);
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
    
    public function edit($id){
        $item = Product::with(['images'])->find($id);
        $id = $item->id;
        $images = $item->images;
        $categories = Category_product::all();
        //dd($item->toArray());
        return view('pages.admin.edit_product')->with('item', $item)->with('categories', $categories)->with('images', $images);
    }
    public function update(Request $request,$id){
        $this->validate($request,[
            'product_name' => 'required',
            'product_price' => 'required|numeric',
            'category_name' => 'required',
            'img.*' => 'image|mimes:jpeg,png,jpg',
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
                $image[$i]->move('upload', $imageName);
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
        $file = $image->product_image;
        if(file_exists('upload/'.$file) && $file != 'image.png'){
            unlink('upload/'.$file);
        }
        $image->delete();
        return redirect()->back();
    }
}