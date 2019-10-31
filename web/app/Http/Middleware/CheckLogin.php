<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckLogin
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
        if (Auth::check()) {
            if (Auth::user()->remember_token == session()->getId()) {
                if(Auth::user()->state == STATE_BLOCK){
                    Auth::logout();
                    return redirect()->route('show_login')->with([
                        'login_fail' => ACCOUNT_BLOCKED
                    ]);
                }
                return $next($request);
            } else {
                Auth::logout();
                return redirect()->route('show_login')->with([
                    'login_fail' => LOGIN_ANOTHER_DEVICE
                ]);
            }
        } else {
            return redirect()->route('show_login');
        }
    }
}
