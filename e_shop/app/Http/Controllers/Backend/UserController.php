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

    public function index(){
        $item = User::all();
        $users = Auth::user();
        $product = Product::count();
        $category = Category_product::count();
        $order = Orders::count();
        return view('pages.admin.dashboard')->with('users', $users)->with('item', $item)->with('product', $product)->with('category', $category)->with('order', $order);
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
                return  '<a href="#" class="btn btn-sm btn- btn-info" style="margin-right:7px"><i class="fas fa-eye"></i></a>'.
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

    public function edit($id){
        $admin = User::where('admin','1')->count();
        $user = User::find($id);
        if($user->admin!=1){
            $user->admin = '1';
            $user->save();
            return redirect()->back()->with('status','User '.$user->fullname.' telah menjadi admin');
        }
        elseif($admin > 1){
            $user->admin = '0';
            $user->save();
            return redirect()->back()->with('status','User '.$user->fullname.' telah menjadi user');
        }
        else{
            return redirect()->back()->with('failed','Status user tidak dapat diubah');
        }      
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
}
