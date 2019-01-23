<?php
namespace App\Http\Controllers\Backend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\File;
use App\User;
use Auth;
class UserController extends Controller
{
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
    }
}