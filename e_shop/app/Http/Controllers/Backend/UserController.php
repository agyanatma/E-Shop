<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\User;

class UserController extends Controller
{
    public function login(){
        return view ('pages.login');
    }

    public function loginStore(Request $request){
        $email = $request->email;
        $password = $request->password;

        $data = User::where('email', $email)->first();
        if($data)
            if(Hash::check($password, $data->password)){
                Session::put('name', $data->fullname);
                Session::put('email', $data->email);
                Session::put('login', true);
                return redirect('/');
            }
            else{
                return redirect('login')->with('alert', 'Password atau Email, Salah!');
            }
        else{
            return redirect('login')->with('alert', 'Password atau Email, Salah!');
        }
    }

    public function signup(Request $request){
        return view ('pages.signup');
    }

    public function signupStore(Request $request){
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
    
}
