<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\User_image;
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
                return response()->json(Status::response((object)array(), 'failed', 'Your credentials invalid', 401), 401);
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
        $user = $user->all();

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
            $user = $user->with('order','product','product.images','categories')->find(Auth::user()->id);

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
            'email' => 'required|email|unique:users',
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
            $email = $request->get('email');
            $name = $request->get('fullname');
            $address = $request->get('address');
            $city = $request->get('city');
            $postal = $request->get('postal_code');
                    
            $user = User::find($id);
            $user->email = $email;
            $user->fullname = $name;
            $user->address = $address;
            $user->city = $city;
            $user->postal_code = $postal;

            if($request->hasFile('profile_image')){
                $file = ('upload'.$update->profile_image);
                if(file_exists($file) && $file !='default.jpg'){
                    unlink($file);
                }
                $image = $request->file('profile_image');
                $imageName = $image->getClientOriginalName();
                $image->move('upload', $imageName);
                $user->profile_image = $imageName;
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
            'password_conf' => 'required'
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
}


    