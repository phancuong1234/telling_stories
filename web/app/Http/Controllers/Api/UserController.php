<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
use JWTAuthException;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Response;

class UserController extends Controller
{
	public function login(Request $request)
	{
		$credentials = $request->only('email', 'password');
		$token = null;
		try {
			if (!$token = JWTAuth::attempt($credentials)) {
				return response()->json([
					'status' => 'error',
					'error' => MESSAGE_ERROR_VALID,
					'code' => CODE_ERROR_VALID
				]);
			}
		} catch (JWTAuthException $e) {
			return response()->json([
				'status' => 'error',
				'error' => '500',
			]);
		}

		return response()->json(['token' => $token], Response::HTTP_OK);
	}

	public function register(Request $request)
	{
		$params = $request->only('email', 'name', 'password');
		$user = new User();
		$check_user= User::where('email','=',$request->email)->get();
		// if($check_user){
		// 	return response()->json([
		// 		'status' => 'error',
		// 		'code' => CODE_ERROR_CREATE,
		// 	]);
		//}else{
			$user->email = $params['email'];
			$user->name = $params['name'];
			$user->password = bcrypt($params['password']);
			$user->save();

			return response()->json([
				'code' => Response::HTTP_OK,
				'data' => $user
			]);
		//}
	}

	public function getUserdata(Request $request)
	{
		if($request->isMethod('get')){
			$user = JWTAuth::user();
			return response()->json([
				'code' => Response::HTTP_OK,
				'data'  => $user,
			]);
		} else {
			return response()->json([
				'error' => MESSAGE_ERROR_METHOD,
				'code'  => CODE_ERROR_METHOD
			]);
		}
	}
}
