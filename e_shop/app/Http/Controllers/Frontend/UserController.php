<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\File;
use App\User;
use App\Product;
use App\Category_product;
use App\Orders;
use App\Order_product;
use App\Order_detail;
use Auth;
use Carbon\Carbon;
Use Illuminate\Support\Facades\Input as input;
use App\Wishlist;
use App\Product_image;
class UserController extends Controller
{

    public function loginaccount(){
        return view ('pages.frontend.loginaccount');
    }
    public function loginaccountStore(Request $request){
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required',
        ],
        [
            'required' => 'Input your email and password to enter!'
        ]);
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', $email)->get();
        if(count($user)>0){
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)){
                $request->session()->put('user_session', Auth::user());
                return redirect()->intended('/')->with('status', 'You has successfully logged in');
            } 
            else {
                return redirect()->back()->with('status', 'Email or password wrong!');
            }
        }
        else{
            return redirect()->back()->with('failed', 'User is not registered!');
        }
    }

    public function registeraccount(Request $request){
        return view ('pages.frontend.registeraccount');
    }

    public function registeraccountStore(Request $request){
        $this->validate($request,[
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
            'fullname' => 'required|max:12',
            'address' => 'required',
            'city' => 'required',
            'postal' => 'required|numeric',
            'img' => 'image|mimes:jpeg,png,jpg'
        ]);
        $user = new User();
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->fullname = $request->fullname;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->postal_code = $request->postal;
        $user->remember_token = $request->_token;
        $user->api_token = bcrypt($request->email);

        if($request->hasFile('img')){
            $image = $request->file('img');
            $imageName = $image->getClientOriginalName();
            $image->move('upload', $imageName);
            $user->profile_image = $imageName;
        }
        else{
            $user->profile_image = 'default.jpg';
        }
        $user->save();
        return redirect('loginaccount')->with('status','You has successfully registered');
    }
    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect('/')->with('status', 'You has successfuly logged out of this account');
    }
    
    public function user($id){
        $users = User::find($id);
        $buyer = Auth::user()->id;
        $totalorder = Order_product::with('product','buyer')->where([
            'user_id' => $buyer,
        ])->count();
        $total = Orders::with('product','buyer')->where('user_id','=',$buyer )->where('status', '=', '0')->sum('total');
        return view('pages.frontend.user')->with('users', $users)
        ->with('buyer', $buyer)
        ->with('total', $total)->with('totalorder', $totalorder);
    }
    
    public function historyorder($id){
        $products = Product::with(['images'])->find($id);
        $users = User::find($id);
        $buyer = Auth::user()->id;
        $orders = Orders::with([
            'orderDetail',
            'orderDetail.product'=>(function($product){
                $product->with(['images'])->get();
            })
        ])->where([
            'user_id' => $id,
        ])->get();
        $totalordermasuk = Orders::with([
            'orderDetail',
            'orderDetail.product'=>(function($product){
                $product->with(['images'])->get();
            })
        ])->where([
            'user_id' => $id,
        ])->count();
        //dd($products->toArray());
        //dd($orderdetail->toArray());
        $totalorder = Order_product::with('product','buyer')->where([
            'user_id' => $buyer,
        ])->count();
        $total = Orders::with('product','buyer')->where('user_id','=',$buyer )->where('status', '=', '0')->sum('total');
        return view('pages.frontend.historyorder')->with('users', $users)
        ->with('buyer', $buyer)->with('orders', $orders)->with('totalordermasuk', $totalordermasuk)
        ->with('total', $total)->with('totalorder', $totalorder)->with('products', $products);
    }

    public function detail($id){
        $orders = Orders::with(['orderDetail','orderDetail.product.categories',])->find($id);
        $details = $orders->orderDetail;
        $buyer = Auth::user()->id;
        $totalorder = Order_product::with('product','buyer')->where([
            'user_id' => $buyer,
        ])->count();
        $totalqty = $details->sum('qty');
        return view('pages.frontend.orderdetail')->with('orders', $orders)->with('details', $details)
        ->with('totalorder', $totalorder)->with('totalqty', $totalqty);
    }
    public function update(Request $request,$id){
        $this->validate($request,[
            'email' => 'required|email',
            'fullname' => 'required|max:12',
            'address' => 'required',
            'city' => 'required',
            'postal' => 'required|numeric',
            'img' => 'image|mimes:jpeg,png,jpg'
        ]);
        
        $email = $request->get('email');
        $name = $request->get('fullname');
        $address = $request->get('address');
        $city = $request->get('city');
        $postal = $request->get('postal');
                
        $user = User::find($id);
        $user->email = $email;
        $user->fullname = $name;
        $user->address = $address;
        $user->city = $city;
        $user->postal_code = $postal;

        if($request->hasFile('img')){
            $file = ('upload/'.$user->profile_image);
            if(file_exists($file) && $file !='default.jpg'){
                unlink($file);
            }
            $image = $request->file('img');
            $imageName = $image->getClientOriginalName();
            $image->move('upload', $imageName);
            $user->profile_image = $imageName;
        }
        $user->save();
        return redirect()->back()->with('status', 'Data has been successfully update!');           
    }

    public function settings($id){
        $users = Auth::user();
        $buyer = Auth::user()->id;
        $totalorder = Order_product::with('product','buyer')->where([
                'user_id' => $buyer,
        ])->count();

        return view('pages.frontend.gantiinfouser')->with('users', $users)
        ->with('buyer', $buyer)->with('totalorder', $totalorder);
        
    }

    public function gantipassword($id){
        $users = Auth::user();
        $buyer = Auth::user()->id;
        $totalorder = Orders::with('product','buyer')->where([
            'user_id' => $buyer,
        ])->count();

        return view('pages.frontend.gantipassword')->with('users', $users)
        ->with('buyer', $buyer)->with('totalorder', $totalorder);
    }

    public function updatepassword(Request $request,$id){
        $this->validate($request,[
            'password' => 'required|min:5',
            'newpassword' => 'required_with:newpasswordconfirm|same:newpasswordconfirm|min:5',
            'newpasswordconfirm' => 'min:5',
        ]);
        $password = $request->get('password');
        $newpassword = $request->get('newpassword');
        $newpasswordconfirm = $request->get('newpasswordconfirm');
        $updatepassword = User::find($id);
        if (Hash::check($request->password, $updatepassword->password)){
            $updatepassword->password = bcrypt($request->get('newpassword'));
            $updatepassword->save();
            return redirect()->back()->withStatus('Password has been updated!');  
             }
        else{
            return redirect()->back()->withError('The current password is incorrect! Please Try Again !');
        }
        
              
    }

    
}