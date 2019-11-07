<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
use JWTAuthException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Repositories\UserRepository\UserRepositoryInterface;

class UserController extends Controller
{
	protected $user;

	public function __construct(UserRepositoryInterface $user)
	{
		$this->user = $user;
	}

	public function login(Request $request)
	{
		$credentials = $request->only('email', 'password');
		if(Auth::attempt($credentials)){
			$id= Auth::id();
			$token= $this->genToken();
			$this->user->updateToken($id,$token);
			return response()->json([
				'token' => $token,
				'code' => Response::HTTP_OK
			]);
		}else{
			return response()->json([
				'code' => CODE_ERROR_VALID,
				'message' => MESSAGE_ERROR_VALID
			]);
		}

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
			$token= getallheaders()['token'];
			$user= User::where('token',$token)->where('delete_flg',0)->first();
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
			//var_dump(getallheaders()['token']);
		
		//echo 'cccc'; exit();
	}

	public function genToken()
	{
		return bin2hex(random_bytes(64));
	}

}
