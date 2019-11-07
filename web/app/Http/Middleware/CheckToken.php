<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use App\Model\User;

class CheckToken
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
        try{
         $token = getallheaders()['token'];
         $existUser = User::where('token',$token)->where('delete_flg',0)->first();
         if(isset($existUser)){
            return $next($request);
        }else {
            return response()->json([
                'error'=>'Unauthorized',
                'code' =>  CODE_ERROR_UNAUTHORIZED
            ]);
        }
    } catch(\Exception $e) {
        return response()->json([
            'error'=>'Unauthorized',
            'code' =>  CODE_ERROR_UNAUTHORIZED
        ]);
    }
}
}
