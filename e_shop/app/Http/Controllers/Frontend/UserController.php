<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\File;
use App\User;
use Auth;

class UserController extends Controller
{
    public function user(){
        
        //dd($profile->toArray();
        return view('pages.frontend.user');
    }
    
    public function loginaccount(){
        
        return view ('pages.frontend.loginaccount');
    }
    
    public function loginaccountStore(Request $request){

        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->email;
        $password = $request->password;

        if($email == 'admin@mail.com' AND $password == 'agyanatma'){
            return redirect('/admin');
        }
        else{
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)){
                $request->session()->put('user_session', Auth::user());
                return redirect()->intended('/');
            } 
            else {
                Session::flash ( 'message', "Invalid Credentials , Please try again." );
                return redirect()->back();
            }
        }
    }

    public function registeraccount(Request $request){
    
            return view('pages.frontend.registeraccount');
    
        
    }

    public function registeraccountStore(Request $request){
        $this->validate($request,[
            'email' => 'required|email',
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

        return redirect('loginaccount')->with('alert-success','Anda berhasil terdaftar');
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect('/index');
    }
}