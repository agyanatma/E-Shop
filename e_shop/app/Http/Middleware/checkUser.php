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
        $userId = $request->id;
        //$idLog = session('user_session')->id;
        
        if(Auth::check()){
            if($userId == Auth::user()->id){
                return $next($request);
            }
            else{
                return abort('404');
            }
        }
        
        return redirect('/loginaccount')->with('gagal','Login terlebih dahulu');
    }
}
