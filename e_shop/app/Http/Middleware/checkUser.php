<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;

class checkUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //$userId = $request->id;
        //$idLog = session('user_session')->id;
        //dd($userId);
        if(Auth::check()){
            
                return $next($request);
        }
        
        return redirect('/loginaccount')->with('gagal','Login terlebih dahulu');
    }
}
