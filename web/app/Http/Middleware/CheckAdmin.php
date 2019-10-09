<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckAdmin
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
        // if (Auth::user()->role_id == ADMIN) {
        //     return $next($request);
        // }else{
        //      return redirect()->route('show_login')->with([
        //     'login_fail' => LOGIN_FAIL
        // ]);
        // }


         if(Auth::user()->role_id == ADMIN){
            return $next($request);
        }
        return redirect('login');
    }
}
