<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use JWTAuth;
use Validator;
use Response;

class RegisterController extends Controller
{
	public function register(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'email' => 'required|string|email|max:255|unique:users',
			'name' => 'required',
			'password'=> 'required'
		]);
		if ($validator->fails()) {
			return response()->json($validator->errors());
		}
		$user= User::create([
			'name' => $request->get('name'),
			'email' => $request->get('email'),
			'password' => bcrypt($request->get('password')),
		]);
        $user = User::first();
		$token = JWTAuth::fromUser($user);

		return response()->json(compact('token'));
	}
}
