<?php
namespace App\Http\Controllers\Backend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\File;
use App\User;
use App\User_image;
use App\Product;
use App\Category_product;
use App\Orders;
use Auth;
class UserController extends Controller
{

    public function dashboard(){
        $item = User::orderBy('created_at', 'desc')->get();
        $users = Auth::user()->with('images')->first();
        $product = Product::count();
        $category = Category_product::count();
        $order = Orders::count();
        $profile = User::count();
        //dd($users->toArray());
        return view('pages.admin.dashboard')->with('users', $users)->with('item', $item)
            ->with('product', $product)->with('category', $category)
            ->with('order', $order)->with('profile', $profile);
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
        $user->api_token = bcrypt($request->email);
        $user->save();
        $user_id = $user->id;

        if($request->hasFile('img')){
            $image = $request->file('img');
            $imageName = $image->getClientOriginalName();
            $image->move('upload', $imageName);
            $upload = new User_image;
            $upload->user_id = $user_id;
            $upload->user_image = $imageName;
            $upload->save();
        }
        else{
            $upload = new User_image;
            $upload->user_id = $user_id;
            $upload->user_image = 'default.jpg';
            $upload->save();
        }
        return redirect('login')->with('alert-success','Anda berhasil terdaftar');
    }
    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
    
    public function profile($id){
        $users = User::with(['images'])->find($id);
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
                
        $user = User::find($id);
        $user->email = $email;
        $user->fullname = $name;
        $user->address = $address;
        $user->city = $city;
        $user->postal_code = $postal;
        $user->save();
        $user_id = $user->id;

        //dd($request->all());
                
        if($request->hasFile('img')){
            $file = ('upload'.$update->profile_image);
            if(file_exists($file)){
                unlink($file);
            }
            $image = $request->file('img');
            $imageName = $image->getClientOriginalName();
            $image->move('upload', $imageName);
            $upload = new User_image;
            $upload->user_id = $user_id;
            $upload->user_image = $imageName;
            $upload->save();
        }
        return redirect()->back()->withErrors('Data berhasil update!');           
    }

    public function admin($id){
        $user = User::find($id);
        if($user->admin!=1){
            $user->admin = '1';
            $user->save();
            return redirect()->back()->with('status','User '.$user->fullname.' telah menjadi admin');
        }
        return redirect()->back();
    }

    public function destroy($id){
        $user = User::find($id);
        $user_id = $user->id;
        $image = User_image::where('user_id', '=', $user_id)->get();
        $file = $image->user_image;
        if(file_exists('upload'.$file)){
            if($file != 'default.jpg'){
                unlink('upload'.$file);
            }
        }
        $image = User_image::where('user_id', '=', $user_id)->delete();
        $user->delete();

        return redirect()->back()->with('status', 'User berhasil dihapus');
    }

    public function deleteImage($id){
        $image = User_image::find($id);
        $file = $image->user_image;
        //dd($image->toArray());
        if(file_exists('upload/'.$file)){
            unlink('upload/'.$file);
        }
        $image->delete();

        return redirect()->back();
    }
}