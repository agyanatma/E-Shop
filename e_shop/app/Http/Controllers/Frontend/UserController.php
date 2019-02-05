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
Use Illuminate\Support\Facades\Input as input;
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
        $categories = Category_product::all();
        //dd($users->toArray());
        if (Auth::user() && $orders = 1){
            $user = Auth::user();
            $buyer = Auth::user()->id;
            $orders = Orders::with('product','buyer')->where('user_id','=',$buyer)->get();
            $qty = Orders::with('product','buyer')->where('user_id','=',$buyer )->where('status', '=', '0');
            $totalqty = Orders::with('product','buyer')->where('user_id','=',$buyer)->where('status', '=', '0')->sum('qty');
            $total = Orders::with('product','buyer')->where('user_id','=',$buyer )->where('status', '=', '0')->sum('total');
            
        return view('pages.frontend.user')->with('categories', $categories)->with('users', $users
            )->with('buyer', $buyer)->with('orders', $orders)->with('category', $categories)
            ->with('total', $total)->with('totalqty', $totalqty)->with('qty', $qty);
        }
        else{

        return view('pages.frontend.user')->with('users', $users)->with('orders', $orders)->with('totalqty', $totalqty)->with('total', $total)->with('totalharga', $totalharga)->with('buyer', $buyer);
        }
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
        $profile_image = $request->get('asdad');
        $email = $request->get('email');
        $name = $request->get('fullname');
        $address = $request->get('address');
        $city = $request->get('city');
        $postal = $request->get('postal');
                
        $update = User::find($id);
        $update->$profile_image;
        $update->email = $email;
        $update->fullname = $name;
        $update->address = $address;
        $update->city = $city;
        $update->postal_code = $postal;  
        // /dd($request->all());
                
        if($request->hasFile('img')){
            $edit = public_path('\upload\{$update->profile_image}');
            if(file_exists($edit)){
                unlink($edit);  
            }
            $image = $request->file('img');
            $imageName = $image->getClientOriginalName();
            
            $image->move('upload', $imageName);
            $update->profile_image = $imageName;
        }
        
        $update->save();
        return redirect()->back()->withErrors('Data berhasil update!');           
    }
    
    public function gantipassword($id){
        $users = Auth::user()->id;
        $users = session()->get('user_session');
        if (Auth::user() && $orders = 1){
            $user = Auth::user();
            $buyer = Auth::user()->id;
            $orders = Orders::with('product','buyer')->where('user_id','=',$buyer)->get();
            $qty = Orders::with('product','buyer')->where('user_id','=',$buyer )->where('status', '=', '0');
            $totalqty = Orders::with('product','buyer')->where('user_id','=',$buyer)->where('status', '=', '0')->sum('qty');
            $total = Orders::with('product','buyer')->where('user_id','=',$buyer )->where('status', '=', '0')->sum('total');
            
        return view('pages.frontend.gantipassword')->with('users', $users)
        ->with('buyer', $buyer)->with('orders', $orders)
            ->with('total', $total)->with('totalqty', $totalqty)->with('qty', $qty);
        }
        else{
        //dd($users);
        return view('pages.frontend.gantipassword')->with('users', $users);
        }
    }

    public function updatepassword(Request $request,$id){
        $this->validate($request,[
            'currentpassword' => 'required|min:5',
            'newpassword' => 'required|min:5',
            'newpasswordconfirm' => 'required|min:5',
        ]);
        // $password = $request->input('password');
        // $user =  User::find(Auth::user()->id);
        // if(Hash::check(Input::get('currentpassword'), $user['password']) && 
        // Input::get('password')==Input::get('newpasswordconfirm')){
        //     $user->password = bcrypt(Input::get('password'));
        //     $user->save();
        //     return back()->with('success', 'Password berhasil diupdate!');    
        // }
        // else {
        //     return back()->with('error', 'Ganti Password Gagal! silakan coba kembali');
        // }
    
        // $password = $request->input('password');
        // $password = $request->get('newpassword');
        // $updatepassword = Auth::user()->id;
        // $updatepassword->password = bcrypt($request->get('newpassword'));
        // $updatepassword ->save();
        // $user->password = bcrypt($request->password);
        
        
              
    }
}