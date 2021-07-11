<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class VendorMiddleware
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
        if(Auth::user()->role_as == 'vendor')
        {
             if(Auth::check() && Auth::user()->isban)
        {
            $banned = Auth::user()->isban == "1";
            Auth::logout();
            if($banned == 1){
                $message = 'Your account has been Banned.Please contact adminstrator';
            }
            return redirect()->route('login')->with('status',$message)->withErrors(['email'=> 'Your account has been  Banned. Please contact administrator.']);
        }
             return $next($request);
        }
        else
        {
            return redirect('/home')->with('status','You are not allowed to access the Dashboard');
        }
       
    }
}
