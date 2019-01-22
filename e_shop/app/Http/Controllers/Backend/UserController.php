<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\File;
use App\User;

class UserController extends Controller
{
    public function login(){
        return view ('pages.login');
    }

    public function loginStore(Request $request){
        $email = $request->email;
        $password = $request->password;

        if($email == 'admin@mail.com' AND $password == 'agyanatma'){
            return redirect('/admin');
        }
        else{
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
    }

    public function signup(Request $request){
        return view ('pages.register');
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

    }
}
