<?php
namespace App\Http\Controllers\Backend;
use Illuminate\Http\Request;
use App\User;
use App\Product;
use App\Category_product;
use App\Orders;
use Session;
use Auth;
use DataTables;

class UserController extends Controller
{

    public function dashboard(){
        $item = User::all();
        $users = Auth::user();
        $product = Product::count();
        $category = Category_product::count();
        $user = User::count();
        $_product = Product::latest()->take(3)->get();
        $_category = Category_product::latest()->take(3)->get();
        $_user = User::latest()->take(3)->get();
        
        return view('pages.admin.dashboard')->with('users', $users)
        ->with('item', $item)
        ->with('product', $product)
        ->with('category', $category)
        ->with('user', $user)
        ->with('_product', $_product)
        ->with('_category', $_category)
        ->with('_user', $_user);
    }

    public function index(){
        $users = User::all();
        //dd($products->toArray());
        return view('pages.admin.index_user')->with('users', $users);
    }

    public function dataTables(){
        $item = User::all();

        return Datatables::of($item)
            ->addColumn('role', function($item){
                if($item->admin=='1'){
                    return "Admin";
                }
                return "User";
            })
            ->addIndexColumn()
            ->addColumn('action', function($item){
                return  '<a href="'.route('show.admin', $item->id).'" class="btn btn-sm btn- btn-info" style="margin-right:7px"><i class="fas fa-eye"></i></a>'.
                        '<a href="'.route('edit.admin', $item->id).'" class="btn btn-sm btn-info" style="margin-right:7px"><i class="fas fa-edit"></i></a>'.
                        '<a href="'.route('destroy.admin', $item->id).'" class="btn btn-sm btn-info"><i class="fas fa-trash-alt"></i></a>';
            })
            ->rawColumns(['action'])
            ->removeColumn('profile_image')
            ->make(true);
    }
    
    public function login(){
        if(Auth::check()){
            return redirect('/admin/dashboard');
        }
        return view('pages.admin.login');
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

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect('/');
    }

    public function show($id){
        $user = User::find($id);
        return view('pages.admin.view_user')->with('user',$user);
    }

    public function edit($id){
        $user = User::find($id);
        return view('pages.admin.edit_user')->with('user',$user);
    }

    public function editStore(Request $request, $id){
        $this->validate($request,[
            'fullname' => 'required|max:12',
            'address' => 'required',
            'city' => 'required',
            'postal' => 'required|numeric',
            'img' => 'image|mimes:jpeg,png,jpg'
        ]);
        
        $name = $request->get('fullname');
        $address = $request->get('address');
        $city = $request->get('city');
        $postal = $request->get('postal');
                
        $user = User::find($id);
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
        return redirect('admin/user')->with('status', 'Data diri berhasil diubah');
    }

    public function destroy($id){
        $user = User::find($id);
        $file = $user->profile_image;
        if(file_exists('upload'.$file) && $file !='default.jpg'){
            unlink('upload'.$file);
        }
        $user->delete();

        return redirect()->back()->with('status', 'User berhasil dihapus');
    }

    public function register(){
        return view ('pages.admin.create_user');
    }

    public function registerStore(Request $request){
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
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->fullname = $request->input('fullname');
        $user->address = $request->input('address');
        $user->city = $request->input('city');
        $user->postal_code = $request->input('postal');
        $user->admin = 1;
        $user->remember_token = $request->_token;
        $user->api_token = bcrypt($request->input('email'));

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
        return redirect('/admin/user')->with('status','Admin berhasil ditambahkan');
    }
}
