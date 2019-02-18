<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\File;
use App\Wishlist;
use App\User;
use App\Product;
use App\Category_product;
use App\Orders;
use App\Order_product;
use App\Order_detail;
use Auth;
use Carbon\Carbon;
Use Illuminate\Support\Facades\Input as input;
class WishlistController extends Controller
{   
    
    public function wishlist(Request $request){
        
        $users = Auth::User();
        $buyer = Auth::user()->id;
        $products = Product::with(['images'])->get();
        $wishlist = Wishlist::where([
            'user_id' => Auth::id()
        ])->paginate(24);
        $totalorder = Order_product::with('product','buyer')->where([
            'user_id' => $buyer,
        ])->count();
        //dd($totalqty);
        return view('pages.frontend.wishlist')
        ->with('products', $products)->with('users', $users)->with('wishlist', $wishlist)
        ->with('buyer', $buyer)->with('totalorder', $totalorder);
    }
    
    public function searchwishlist(Request $request){
        $keyword = $request->get('title');
        $buyer = Auth::user()->id;
        $users = Auth::User();
        $wishlist = Wishlist::where([
            'user_id' => Auth::id()
        ]);
        if ($request->has('title') && $request->get('title') != '') {
            //dd($keyword);
            $wishlist->whereHas('product', function ($q) use ($keyword) {
                $q->where('product_name', 'like', '%'.$keyword.'%');
            });
        }
        //dd($wishlist->toSql());
        $wishlist = $wishlist->paginate(24);
        $totalorder = Order_product::with('product','buyer')->where([
            'user_id' => $buyer,
        ])->count();
        
        return view('pages.frontend.searchwishlist')
        ->with('users', $users)
        ->with('buyer', $buyer)->with('wishlist', $wishlist)
        ->with('totalorder', $totalorder);
    }
    
    public function tambahwishlist(Request $request, $id){
        if($products = Product::find($id)){
            $user = $request->input('user_id');
            $product = $request->input('product_id');
            $time = Carbon::today();
            //dd($request->price);
            //cek order sudah ada atau belum
            $wishlist = Wishlist::where([
                'user_id' => $user,
                'product_id' => $product,
            ])->first();
            //jika sudah ada
            if ($wishlist) {
                $wishlist->save();
            } 
            //jika belum
            else {
                $store = new Wishlist;
                $store->user_id = $user;
                $store->product_id = $product;
                $store->save();
            }
            
            return redirect()->back()->with('status', 'Product added to wishlist successfully!');
        }
    }

    public function deletewishlist($id){
        $wishlist = Wishlist::find($id);
        $wishlist->delete();
        return redirect()->back()->with('status', 'Data has been successfully deleted');   
    }
    
    public function ubahwishlist(){
        $users = Auth::User();
        $buyer = Auth::user()->id;
           
        $wishlist = Wishlist::with('product','buyer')->where([
            'user_id' => $buyer,
        ])->paginate(24);
        $totalorder = Order_product::with('product','buyer')->where([
             'user_id' => $buyer,
        ])->count();
        return view('pages.frontend.ubahwishlist')->with('users', $users)
        ->with('buyer', $buyer)->with('totalorder', $totalorder)
        ->with('wishlist', $wishlist);
    }
    
}
