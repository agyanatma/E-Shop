<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Wishlist;
use App\Transformers\UserTransformer;
use App\Transformers\Status;
use Auth;
use Hash;


class UserController extends Controller
{
    //AUTHENTICATION=====================================================================================================================================

    public function register(Request $request, User $user){
        $validate = \Validator::make($request->all(),[
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
            'fullname' => 'required',
            'address' => 'required',
            'city' => 'required',
            'postal_code' => 'required|numeric',
            'profile_image' => 'image|mimes:jpeg,png,jpg'
        ]);
        if($validate->fails()){
                return response()->json([
                    'user'      =>(object)array(), 
                    'status'    =>'failed',
                    'message'   =>$validate->messages()->first(),
                    'code'      =>'422'], 422);
            }
        
        try{
            $user = new User();
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->fullname = $request->fullname;
            $user->address = $request->address;
            $user->city = $request->city;
            $user->postal_code = $request->postal_code;
            $user->api_token = bcrypt($request->email);

            if($request->hasFile('profile_image')){
                $image = $request->file('profile_image');
                $imageName = $image->getClientOriginalName();
                $image->move('upload', $imageName);
                $user->profile_image = $imageName;
            }
            else{
                $user->profile_image = 'default.jpg';
            }
            $user->save();

            if(!$user){
                return response()->json([
                    'user'      =>(object)array(), 
                    'status'    =>'error',
                    'message'   =>'Nothing Happen',
                    'code'      =>'404'], 404);
            }
            
            return response()->json([
                'user'      =>$user,
                'status'    =>'success',
                'message'   =>'Register success',
                'code'      =>'200'], 200);
        }
        catch(\Exception $e){
            return response()->json([
                'user'      =>(object)array(), 
                'status'    =>'error',
                'message'   =>$e->getMessage(),
                'code'      =>'404'], 404);
        }
    }

    public function login(Request $request, User $user){
        $validate = \Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);
        if($validate->fails()){
            return response()->json([
                'user'      =>(object)array(), 
                'status'    =>'failed',
                'message'   =>$validate->messages()->first(),
                'code'      =>'422'], 422);
        }

        try{
            if(! Auth::attempt(['email' =>$request->email, 'password' =>$request->password])){
                if($validate->fails()){
                    return response()->json([
                        'user'      =>(object)array(), 
                        'status'    =>'failed',
                        'message'   =>'Your credential invalid',
                        'code'      =>'401'], 401);
                }
            }
    
            $user = $user->find(Auth::user()->id);

            if(!$user){
                return response()->json([
                    'user'      =>(object)array(), 
                    'status'    =>'error',
                    'message'   =>'Nothing Happen',
                    'code'      =>'404'], 404);
            }
            
            return response()->json([
                'user'      =>$user,
                'status'    =>'success',
                'message'   =>'Login success',
                'code'      =>'200'], 200);
        }
        catch(\Exception $e){
            return response()->json([
                'user'      =>(object)array(), 
                'status'    =>'error',
                'message'   =>$e->getMessage(),
                'code'      =>'404'], 404);
        }
        
    }

    //=================================================================================================================================================


    //USER=============================================================================================================================================

    public function index(User $user){
        try{
            $user = User::select(
                'id','email','fullname','address','city','postal_code','profile_image'
            )->get();

            if(!$user){
                return response()->json([
                    'user'      =>(object)array(), 
                    'status'    =>'error',
                    'message'   =>'Nothing Happen',
                    'code'      =>'404'], 404);
            }
            
            return response()->json([
                'user'      =>$user,
                'status'    =>'success',
                'message'   =>'Get data success',
                'code'      =>'200'], 200);
        }
        catch(\Exception $e){
            return response()->json([
                'user'      =>(object)array(), 
                'status'    =>'error',
                'message'   =>$e->getMessage(),
                'code'      =>'404'], 404);
        }
    }

    public function profile(User $user){
        try{
            $user = $user->with(['order','order.product','order.product.images'])->find(Auth::id());

            if(!$user){
                return response()->json([
                    'user'      =>(object)array(), 
                    'status'    =>'error',
                    'message'   =>'Nothing Happen',
                    'code'      =>'404'], 404);
            }
            
            return response()->json([
                'user'      =>$user,
                'status'    =>'success',
                'message'   =>'Get data success',
                'code'      =>'200'], 200);
        }
        catch(\Exception $e){
            return response()->json([
                'user'      =>(object)array(), 
                'status'    =>'error',
                'message'   =>$e->getMessage(),
                'code'      =>'404'], 404);
        }
    }
    
    public function update(Request $request, User $user){
        $validate = \Validator::make($request->all(),[
            'fullname' => 'max:30',
            'address' => 'max:50',
            'city' => 'max:50',
            'postal_code' => 'numeric',
            'profile_image' => 'image|mimes:jpeg,png,jpg'
        ]);
        if($validate->fails()){
            return response()->json([
                'user'      =>(object)array(), 
                'status'    =>'failed',
                'message'   =>$validate->messages()->first(),
                'code'      =>'422'], 422);
        }
        
        try{
            $user->update($request->except(
                'email','password','api_token','admin'
            ));

            if(!$user){
                return response()->json([
                    'user'      =>(object)array(), 
                    'status'    =>'error',
                    'message'   =>'Nothing Happen',
                    'code'      =>'404'], 404);
            }
            
            return response()->json([
                'user'      =>$user,
                'status'    =>'success',
                'message'   =>'Update success',
                'code'      =>'200'], 200);
        }
        catch(\Exception $e){
            return response()->json([
                'user'      =>(object)array(), 
                'status'    =>'error',
                'message'   =>$e->getMessage(),
                'code'      =>'404'], 404);
        }
    }

    public function password(Request $request, User $user){
        $validate = \Validator::make($request->all(),[
            'current' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);
        if($validate->fails()){
            return response()->json([
                'user'      =>(object)array(), 
                'status'    =>'failed',
                'message'   =>$validate->messages()->first(),
                'code'      =>'422'], 422);
        }
        
        try{
            $user = $user->find(Auth::id());

            if(!Hash::check($request->current,$user->password)){
                return response()->json([
                    'user'      =>(object)array(), 
                    'status'    =>'failed',
                    'message'   =>'Current password invalid',
                    'code'      =>'422'], 422);
            }
            $user->password = bcrypt($request->password);
            $user->save();

            if(!$user){
                return response()->json([
                    'user'      =>(object)array(), 
                    'status'    =>'error',
                    'message'   =>'Nothing Happen',
                    'code'      =>'404'], 404);
            }
            
            return response()->json([
                'user'      =>$user,
                'status'    =>'success',
                'message'   =>'Update success',
                'code'      =>'200'], 200);
        }
        catch(\Exception $e){
            return response()->json([
                'user'      =>(object)array(), 
                'status'    =>'error',
                'message'   =>$e->getMessage(),
                'code'      =>'404'], 404);
        }
    }

//====================================================================================================================================================

//WISHLIST FUNCTION===================================================================================================================================

    public function wishlist(Wishlist $wishlist){
        try{
            $wishlist = Wishlist::with(['product','product','product.images'])->where('user_id','=',Auth::id())->get();

            if(!$wishlist){
                return response()->json([
                    'wishlist'  =>array(), 
                    'status'    =>'error',
                    'message'   =>'Nothing Happen',
                    'code'      =>'404'], 404);
            }
            
            return response()->json([
                'wishlist'  =>$wishlist,
                'status'    =>'success',
                'message'   =>'Get data success',
                'code'      =>'200'], 200);
        }
        catch(\Exception $e){
            return response()->json([
                'wishlist'  =>array(), 
                'status'    =>'error',
                'message'   =>$e->getMessage(),
                'code'      =>'404'], 404);
        }
    }


    public function add(Request $request, Wishlist $wishlist){
        try{
            $validate = \Validator::make($request->all(),[
                'product' => 'required'
            ]);
            if($validate->fails()){
                return response()->json([
                    'wishlist'  =>array(), 
                    'status'    =>'failed',
                    'message'   =>$validate->messages()->first(),
                    'code'      =>'422'], 422);
            }

            $item = new Wishlist;
            $item->user_id = Auth::id();
            $item->product_id = $request->product;
            $item->save();
            $wishlist = Wishlist::with(['product','product','product.images'])->where('user_id','=',Auth::id())->get();

            if(!$wishlist){
                return response()->json([
                    'wishlist'   =>array(), 
                    'status'    =>'error',
                    'message'   =>'Nothing Happen',
                    'code'      =>'404'], 404);
            }
            return response()->json([
                'wishlist'   =>$wishlist, 
                'status'    =>'success',
                'message'   =>'Add success',
                'code'      =>'200'], 200);
        }
        catch(\Exception $e){
            return response()->json([
                'wishlist'   =>array(), 
                'status'    =>'error',
                'message'   =>$e->getMessage(),
                'code'      =>'404'], 404);
        }
    }

    public function destroy($id){
        try{
            $item = Wishlist::find($id);
            $item->delete();

            if(!$item){
                return response()->json([
                    'wishlist'   =>array(), 
                    'status'    =>'error',
                    'message'   =>'Nothing Happen',
                    'code'      =>'404'], 404);
            }
            return response()->json([
                'wishlist'   =>array(), 
                'status'    =>'success',
                'message'   =>'Delete success',
                'code'      =>'200'], 200);
        }
        catch(\Exception $e){
            return response()->json([
                'wishlist'   =>array(), 
                'status'    =>'error',
                'message'   =>$e->getMessage(),
                'code'      =>'404'], 404);
        }
    }
}


    