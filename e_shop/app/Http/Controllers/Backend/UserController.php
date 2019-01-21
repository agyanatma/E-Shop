<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function login(){
        return view ('pages.login');
    }

    public function signup(){
        return view ('pages.signup');
    }
}
