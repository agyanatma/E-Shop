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
use Auth;

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
            'required' => 'Masukkan email dan password untuk masuk!'
        ]);
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', $email)->get();
        if(count($user)>0){
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)){
                $request->session()->put('user_session', Auth::user());
                return redirect()->intended('/');
            } 
            else {
                return redirect()->back()->with('status', 'Email atau password salah!');
            }
        }
        else{
            return redirect()->back()->with('failed', 'Pengguna tidak terdaftar');
        }
    }

    public function registeraccount(Request $request){
        return view ('pages.frontend.registeraccount');
    }

    public function registeraccountStore(Request $request){
        $this->validate($request,[
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
            'fullname' => 'required',
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
            $storage = public_path('\upload');
            $image->move($storage, $imageName);
            $user->profile_image = $imageName;
        }
        else{
            $user->profile_image = 'default.jpg';
        }
        $user->save();
        return redirect('loginaccount')->with('alert-success','Anda berhasil terdaftar');
    }
    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
    
    public function user($id){
        $users = User::find($id);
        $orders = Auth::user()->orders;
        $buyer = Auth::user()->id;
        $orders = Orders::with('product','buyer')->where('user_id','=',$buyer)->get();
        $categories = Category_product::all();
        $total = Orders::with('product','buyer')->where('user_id','=',$buyer)->sum('total');
        $qty = Orders::with('product','buyer')->where('user_id','=',$buyer)->sum('qty');
        $totalharga = $total * $qty;
        //dd($orders->toArray());
        return view('pages.frontend.user')->with('users', $users)->with('orders', $orders)->with('qty', $qty)->with('total', $total)->with('totalharga', $totalharga);
    }
    
    
    
    public function password($id){
    }
}