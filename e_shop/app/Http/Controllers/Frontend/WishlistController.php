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
use Auth;
use Carbon\Carbon;
Use Illuminate\Support\Facades\Input as input;
class WishlistController extends Controller
{   
    
    public function wishlist(Request $request){
        
        $users = Auth::User();
        // /dd($wishlist->toArray());
        //dd($wishlist->toArray());
        if (Auth::user() && $orders = 1){
            $user = Auth::user();
            $buyer = Auth::user()->id;
            $products = Product::with(['images'])->get();
            $wishlist = Wishlist::where([
                'user_id' => Auth::id()
            ])->paginate(24);
            $totalorder = Orders::with('product','buyer')->where([
                'user_id' => $buyer,
                'status' => 0,
            ])->count();
            //dd($totalqty);
            return view('pages.frontend.wishlist')
            ->with('products', $products)->with('user', $user)->with('users', $users)
            ->with('buyer', $buyer)->with('orders', $orders)->with('totalorder', $totalorder)
            ->with('wishlist', $wishlist);
        }
        else{
            return view('pages.frontend.wishlist')->with('products', $products)->with('wishlist', $wishlist)
            ->with('users', $users);
        }
        
        
            
    }
    
    public function searchwishlist(Request $request){
        $wishlists = Wishlist::where([
            'user_id' => Auth::id()
        ])->get();

        $keyword = $request->get('title');
        $buyer = Auth::user()->id;
        $users = Auth::User();
        //dd($products->toArray());
        if (Auth::user() && $orders = 1){
            $user = Auth::user();
            $buyer = Auth::user()->id;
            // $s = $request->input('s');
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
            $wishlist = $wishlist->get();
        
            $totalorder = Orders::with('product','buyer')->where([
                'user_id' => $buyer,
                'status' => 0,
            ])->count();

            //dd($wishlist->toArray());
            $qty = Orders::with('product','buyer')->where('user_id','=',$buyer )->where('status', '=', '0');
            $totalqty = Orders::with('product','buyer')->where('user_id','=',$buyer)->where('status', '=', '0')->sum('qty');
            
            //dd($totalqty);
            return view('pages.frontend.searchwishlist')
            ->with('user', $user)->with('users', $users)
            ->with('buyer', $buyer)->with('orders', $orders)->with('wishlist', $wishlist)
            ->with('totalqty', $totalqty)->with('qty', $qty)->with('totalorder', $totalorder);
            // ->with('wishlist', $wishlist);
        }
        else{
            return view('pages.frontend.searchwishlist')->with('wishlist', $wishlist)
            ->with('users', $users);
        }
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
        // /dd($wishlist->toArray());
        //dd($wishlist->toArray());
        if (Auth::user() && $orders = 1){
            $user = Auth::user();
            $buyer = Auth::user()->id;
            $products = Product::with(['images'])->get();
            $wishlist = Wishlist::with('product','buyer')->where([
                'user_id' => $buyer,
            ])->paginate(24);
            $totalorder = Orders::with('product','buyer')->where([
                'user_id' => $buyer,
                'status' => 0,
            ])->count();
            return view('pages.frontend.ubahwishlist')
            ->with('products', $products)->with('user', $user)->with('users', $users)
            ->with('buyer', $buyer)->with('orders', $orders)->with('totalorder', $totalorder)
            ->with('wishlist', $wishlist);
        }
        else{
            return view('pages.frontend.ubahwishlist')->with('products', $products)->with('wishlist', $wishlist)
            ->with('users', $users);
        }
    }
    
}
