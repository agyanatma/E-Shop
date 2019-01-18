<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('pages.user')->with('users', $users);
    }
}
