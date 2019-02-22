<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Product;
use App\Product_image;
use App\Category_product;
use App\User;
use App\Orders;
use App\Order_product;
use App\Order_detail;
use Carbon\Carbon;
use Auth;
use Stripe\Stripe;
use App\Wishlist;
use Session;
use DB;
class OrderController extends Controller
{
    public function cart(){
        $products = Product::with(['images'])->get();
        $users = Auth::User();
        $buyer = Auth::user()->id;
        $orders = Order_product::with('product','buyer')->where('user_id','=',$buyer)->get();
        $totalorder = Order_product::with('product','buyer')->where([
            'user_id' => $buyer,
        ])->count();
        //dd($totalorder);
        $productrandom = Product::inRandomOrder()->with(['images'])->take(6)->get();
        //dd($productrandom);
        $totalqty = Order_product::with('product','buyer')->where('user_id','=',$buyer)->sum('qty');
        //dd($total);
        $oldCart = Session::get('cart');
        //dd($oldCart);
        return view('pages.frontend.cart')->with('products', $products)->with('users', $users)
        ->with('buyer', $buyer)->with('orders', $orders)
        ->with('totalqty', $totalqty)
        ->with('productrandom', $productrandom)->with('totalorder', $totalorder);
    }


    public function updatecart(Request $request, $id){
        if($products = Product::find($id)){
            
            $quantity = $request->input('quantity');
            $user = $request->input('user_id');
            $product = $request->input('product_id');
            
            $order = Order_product::where([
                'user_id' => $user,
                'product_id' => $product,
            ])->first();

            if ($order) {
                $order->qty = $quantity;
                $order->save();
            }
            //dd($request->all());
            return redirect()->back()->with('status', 'Quantity of product has been edited form cart successfully!');
        }
    }


    public function deleteCart($id){
        $order = Order_product::find($id);
        $order->delete();
        return redirect()->back()->with('status', 'Data has been remove successfully');   
    }
    
    public function checkout(Request $request, $id){
       
        if($products = Product::find($id)){
            $user = $request->input('user_id');
            $product = $request->input('product_id');
            $quantity = $request->input('qty');
            $order = Order_product::where([
                'user_id' => $user,
                'product_id' => $product,
            ])->first();
            if ($order) {
                $order->qty += $quantity;
                $order->save();
            } 
            //jika belum
            else {
                $store = new Order_product;
                $store->user_id = $user;
                $store->product_id = $product;
                $store->qty = $quantity;
                $store->save();
            }
            return redirect()->back()->with('status', 'Product added to cart successfully!');
        }
        else{
            return redirect()->back()->with('error', 'Product added to cart successfully!');
        }
        
    }

    public function bayar($id){
        $user = Auth::user();
        $product = Order_product::where('user_id',Auth::id())->with(['product'])->get();
        $price = 0;
        foreach($product as $item){
            $price = $price + $item->product->product_price * $item->qty;
        }
        $order = Orders::create([
            'user_id' =>$user->id,
            'email' =>$user->email,
            'fullname' =>$user->fullname,
            'address' =>$user->address,
            'city'  =>$user->city,
            'postal_code' =>$user->postal_code,
            'order_date' =>Carbon::now(),
            'total' => $price,
        ]);
        foreach($product as $item){
            $detail[] = [
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'price' => $item->product->product_price,
                'qty' => $item->qty,
            ];
        }
        DB::table('Order_details')->insert($detail);
        Order_product::where('user_id',Auth::id())->delete();
        return redirect()->route('paymentcard', $order->id)->with('status','Order success, Please do payment as soon as possible !');
    }

    public function updatestatusbayarlangsung(Request $request, $id){
        
        $status = $request->all;
        $id = Auth::user()->id;
        $order = Orders::where([
            ['user_id','=',$id],
            ['status','=','0'],
        ])->update(['status' => '1']);

        return redirect()->route('userPage');
    }

    public function tambahlangsung(Request $request, $id){
        if($products = Product::find($id)){
            $user = $request->input('user_id');
            $product = $request->input('product_id');
            $quantity = $request->input('quantity', '1');
            
            $order = Order_product::where([
                'user_id' => $user,
                'product_id' => $product,
            ])->first();
            //jika sudah ada
            if ($order) {
                $order->qty += $quantity;
                $order->save();
            } 
            //jika belum
            else {
                $store = new Order_product;
                $store->user_id = $user;
                $store->product_id = $product;
               
                $store->qty = $quantity;
               
                $store->save();
            }

        return redirect()->back()->with('status','Items has been added to cart successfully');
        }
    }

    public function langsungbayar(Request $request, $id){
        
        if($products = Product::find($id)){
            $user = $request->input('user_id');
            $product = $request->input('product_id');
            $quantity = $request->input('quantity', '1');
            $order = Order_product::where([
                'user_id' => $user,
                'product_id' => $product,
            ])->first();
            //jika sudah ada
            if ($order) {
                $order->qty += $quantity;
                $order->save();
            } 
            //jika belum
            else {
                $store = new Order_product;
                $store->user_id = $user;
                $store->product_id = $product;
                $store->qty = $quantity;
                $store->save();
            }
        
        $products = Product::with(['images'])->get();
        $users = Auth::User();
        $buyer = Auth::user()->id;
        $orders = Order_product::with('product','buyer')->where('user_id','=',$buyer)->get();
        $order_details = Order_product::with('product','buyer')->where('user_id','=',$buyer)->get();//dd($orders->toArray());
        $totalorder = Order_product::with('product','buyer')->where([
            'user_id' => $buyer,
        ])->count();
        
        $totalqty = Order_product::with('product','buyer')->where('user_id','=',$buyer)->sum('qty');

            return view('pages.frontend.langsungbayargan')->with('products', $products)->with('users', $users)
            ->with('buyer', $buyer)->with('orders', $orders)
            ->with('totalqty', $totalqty)->with('totalorder', $totalorder)
            ->with('status','Items has been added to payment successfully');
        }
        else{
            return redirect()->back()->with('error','Items cant added to cart ! please check again!');
        }
    }

    public function getcheckoutgan(){
        $products = Product::with(['images'])->get();
        $users = Auth::User();
        $buyer = Auth::user()->id;
        // $ordersproduct = Orders::all();
        $orders = Order_product::with('product','buyer')->where('user_id','=',$buyer)->get();
        $totalorder = Order_product::with('product','buyer')->where([
            'user_id' => $buyer,
        ])->count();
        
        $totalqty = Order_product::with('product','buyer')->where('user_id','=',$buyer)->sum('qty');
        //dd($ordersproduct);
        return view('pages.frontend.checkoutgan')->with('products', $products)->with('users', $users)
        ->with('buyer', $buyer)->with('orders', $orders)->with('totalqty', $totalqty)
        ->with('totalorder', $totalorder);
    }

    public function paymentgan($id){
        // $orders = Orders::find($id);
        $buyer = Auth::user()->id;
        $orders = Orders::with([
            'orderDetail',
            'orderDetail.product'=>(function($product){
                $product->with(['images'])->get();
            })
        ])->where([
            'user_id' => Auth::user()->id,
        ])->find($id);
        //dd($orders->toArray);
        $totalorder = Order_product::with('product','buyer')->where([
            'user_id' => $buyer,
        ])->count();
        
        // dd($orders->toArray());
        return view('pages.frontend.payment')->with('totalorder', $totalorder)
        ->with('orders', $orders);
    }
    
    public function paymentordergan(Orders $order, Request $request, $id){
        $this->validate($request,[
            'payment' => 'image|mimes:jpeg,png,jpg'
        ]);
       
        //dd($payment);
        if($order->status==0){
            $order = Orders::find($id);
            if($request->hasFile('payment')){
            $image = $request->file('payment');
            $imageName = $image->getClientOriginalName();
            $image->move('upload', $imageName);
            $order->payment_check = $imageName;
            }
            $order->status = '1';
            $order->save();
            return redirect()->route('userPage')->with('status','Order number '.$id.' has been registered. Please wait for confirmation!!');
        }
        else{
            return redirect()->back()->with('error','Order number '.$id.'not yet pay');
        }
        
    }
}
