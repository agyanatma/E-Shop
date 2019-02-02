<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\User_image;
use App\Transformers\UserTransformer;
use App\Transformers\Status;
use Auth;


class UserController extends Controller
{
    //AUTHENTICATION=====================================================================================================================================

    public function register(Request $request, User $user){
        $this->validate($request,[
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
            'fullname' => 'required',
            'address' => 'required',
            'city' => 'required',
            'postal_code' => 'required|numeric',
            'profile_image' => 'image|mimes:jpeg,png,jpg'
        ]);

        try{
            $user = new User();
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->fullname = $request->fullname;
            $user->address = $request->address;
            $user->city = $request->city;
            $user->postal_code = $request->postal_code;
            $user->api_token = bcrypt($request->email);
            $user->save();
            $user_id = $user->id;

            if($request->hasFile('profile_image')){
                $image = $request->file('profile_image');
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
    
            $response = fractal()
                ->item($user)
                ->transformWith(new UserTransformer)
                ->addMeta([
                    'token' =>$user->api_token,
                ])
                ->toArray();
            if(!$user){
                return response()->json(Status::response(null, 'error', 'Nothing Found', 404), 404);
            }
            return response()->json(Status::response($response, 'success', 'Register success', 201), 201);
        }
        catch(\Exception $e){
            return response()->json(Status::response(null, 'error', $e->getMessage()), 404);
        }
    }

    public function login(Request $request, User $user){
        try{
            if(! Auth::attempt(['email' =>$request->email, 'password' =>$request->password])){
                return response()->json(['error' => 'Your credential invalid'], 401);
            }
    
            $user = $user->find(Auth::user()->id);
    
            $response = fractal()
                ->item($user)
                ->transformWith(new UserTransformer)
                ->addMeta([
                    'token' =>$user->api_token,
                ])
                ->toArray();
            if(!$user){
                return response()->json(Status::response(null, 'error', 'Nothing Found', 404), 404);
            }
            return response()->json(Status::response($response, 'success', 'Login success', 200), 200);
        }
        catch(\Exception $e){
            return response()->json(Status::response(null, 'error', $e->getMessage()), 404);
        }
        
    }

    //=================================================================================================================================================


    //USER=============================================================================================================================================

    public function index(User $user){
        try{
        $user = $user->with('images')->get();

        $response = fractal()
            ->collection($user)
            ->transformWith(new UserTransformer)
            ->toArray();

            if(!$user){
                return response()->json(Status::response(null, 'error', 'Nothing Found', 404), 404);
            }
            return response()->json(Status::response($response, 'success', 'Get data success', 200), 200);
            }
        catch(\Exception $e){
            return response()->json(Status::response(null, 'error', $e->getMessage()), 404);
        }
    }

    public function profile(User $user){
        try{
            $user = $user->find(Auth::user()->id);

            $response = fractal()
                ->item($user)
                ->transformWith(new UserTransformer)
                ->includeOrder()
                ->toArray();

            if(!$user){
                return response()->json(Status::response(null, 'error', 'Nothing Found', 404), 404);
            }
            return response()->json(Status::response($response, 'success', 'Get data success', 200), 200);
            }
        catch(\Exception $e){
            return response()->json(Status::response(null, 'error', $e->getMessage()), 404);
        }
    }
    
    public function update(Request $request, User $user){
        $this->validate($request,[
            'email' => 'required|email',
            'fullname' => 'required',
            'address' => 'required',
            'city' => 'required',
            'postal_code' => 'required|numeric',
            //'profile_image' => 'image|mimes:jpeg,png,jpg'
        ]);
        
        try{
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
        $user->postal_code = $postal_code;
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

        $response = fractal()
                ->item($user)
                ->transformWith(new UserTransformer)
                ->addMeta([
                    'token' =>$user->api_token,
                ])
                ->toArray();
            if(!$user){
                return response()->json(Status::response(null, 'error', 'Nothing Found', 404), 404);
            }
            return response()->json(Status::response($response, 'success', 'Update success', 201), 201);
        }
        catch(\Exception $e){
            return response()->json(Status::response(null, 'error', $e->getMessage()), 404);
        }
    }
}
