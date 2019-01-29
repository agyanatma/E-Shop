<?php

namespace App\Http\Controllers\Backend;

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

    public function dashboard(){
        $item = User::orderBy('created_at')->get();
        $users = session()->get('user_session');
        $product = Product::count();
        $category = Category_product::count();
        $order = Orders::count();
        //$user = User::with('order')->get();
        //dd($user->toArray());
        return view('pages.admin.dashboard')->with('users', $users)->with('item', $item)->with('product', $product)->with('category', $category)->with('order', $order);
    }

    public function login(){
        return view ('pages.login');
    }

    public function loginStore(Request $request){

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
            if (! Auth::attempt($credentials)){
                return redirect()->back()->with('status', 'Email atau password salah!');
            } 
            $request->session()->put('user_session', Auth::user());
            return redirect()->intended('/');
        }
        else{
            return redirect()->back()->with('failed', 'Pengguna tidak terdaftar');
        }
    }

    public function loginAdmin(Request $request){

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
            if (! Auth::attempt($credentials)){
                return redirect()->back()->with('failed', 'Email atau password salah!');
            } 
            $request->session()->put('user_session', Auth::user());
            if(! Auth::user()->admin==1){
                Session::flush();
                Auth::logout();
                return redirect()->back()->with('failed', 'Anda bukan termasuk admin');
            }
            return redirect('admin/dashboard');
        }
        else{
            return redirect()->back()->with('failed', 'Pengguna tidak terdaftar');
        }
    }

    public function signup(Request $request){
        return view ('pages.register');
    }

    public function signupStore(Request $request){
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

        return redirect('login')->with('alert-success','Anda berhasil terdaftar');
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
    
    public function profile($id){
        $users = User::find($id);
        //dd($profile->toArray());
        return view('pages.profile')->with('users', $users);
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'email' => 'required|email',
            'fullname' => 'required',
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
                
        $update = Product::find($id);
        $update->email = $email;
        $update->fullname = $name;
        $update->address = $address;
        $update->city = $city;
        $update->postal_code = $postal;  
        //dd($request->all());
                
        if($request->hasFile('img')){
            $edit = public_path('\upload\{$update->profile_image}');
            if(File::exists($edit)){
                unlink($edit);  
            }
            $image = $request->file('img');
             $imageName = $image->getClientOriginalName();
            $storage = public_path('\upload');
            $image->move($storage, $imageName);
            $update->profile_image = $imageName;
        }
        $update->save();

        return redirect()->back()->withErrors('Data berhasil update!');           
    }
    
    public function password($id){
        $password = $request->input('password');
    }
}
