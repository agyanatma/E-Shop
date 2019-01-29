<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Transformers\UserTransformer;
use App\Transformers\OrderTransformer;
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
            //'image' => 'image|mimes:jpeg,png,jpg'
        ]);

        $user = $user->create([
            'email' =>$request->email,
            'password' =>bcrypt($request->password),
            'fullname' =>$request->fullname,
            'address' =>$request->address,
            'city' =>$request->city,
            'postal_code' =>$request->postal_code,
            //'profile_image' =>$request->image,
            'api_token' =>bcrypt($request->email)
        ]);

        $response = fractal()
            ->item($user)
            ->transformWith(new UserTransformer)
            ->addMeta([
                'token' =>$user->api_token,
            ])
            ->toArray();

        return response()->json($response, 201);
        
        /*$user = new User();
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->fullname = $request->fullname;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->postal_code = $request->postal;
        $user->api_token = bcrypt($request->email);
        $user->remember_token = $request->_token;
        if($request->hasFile('img')){
            $image = $request->file('img');
            $imageName = $image->getClientOriginalName();
            $storage = public_path('\upload');
            $image->move($storage, $imageName);
            $user->profile_image = $imageName;
        }*/

    }

    public function login(Request $request, User $user){
        if(! Auth::attempt(['email' =>$request->email, 'password' =>$request->password])){
            return response()->json(['error' => 'Your credential invalid'], 401);
        }

        $user = $user->find(Auth::user()->id);

        return fractal()
            ->item($user)
            ->transformWith(new UserTransformer)
            ->addMeta([
                'token' =>$user->api_token,
            ])
            ->toArray();
    }

    //=================================================================================================================================================


    //USER=============================================================================================================================================

    public function index(User $user){
        $users = $user->all();

        $response = fractal()
            ->collection($users)
            ->transformWith(new UserTransformer)
            ->toArray();
        
        return response()->json($response, 201);
    }

    public function profile(User $user){
        $users = $user->find(Auth::user()->id);

        return fractal()
            ->item($users)
            ->transformWith(new UserTransformer)
            ->includeOrders()
            ->toArray();
    }
    
    public function edit(Request $request, User $user){
        $user->fullname = $request->get('fullname', $user->fullname);
        $user->address = $request->get('address', $user->address);
        $user->city = $request->get('city', $user->city);
        $user->fullname = $request->get('fullname', $user->fullname);
        $user->fullname = $request->get('fullname', $user->fullname);
    }
}
