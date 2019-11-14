<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
use JWTAuthException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Repositories\UserRepository\UserRepositoryInterface;
use App\Notifications\UserResetPassword;
use App\Notifications\Feedback;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

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
		$checkEmail= $this->user->checkExistEmail($request->email);
		if($checkEmail){
			return response()->json([
				'message' => MESSAGE_EMAIL_INVALID,
				'code' => CODE_ERROR_VALID,
			]);
		}else{
			$user= $this->user->createUser($params);
			return response()->json([
				'code' => Response::HTTP_OK,
				'data' => $user
			]);
		}
	}

	public function sendMail(Request $request)
	{


		$user = User::where('email', $request->email)->first();
		$token= $this->genToken();

		$passwordReset = User::where('email', $request->email)->update([
			'token' => $token
		]);
		
		$user->notify(new UserResetPassword($token));  
		return response()->json([
			'message' => 'We have e-mailed your password reset link!'
		]);
	}

	public function find($token)
	{
		$user = User::where('token', $token)
		->first();
		if (!$user)
			return response()->json([
				'message' => 'This password reset token is invalid.',
				'code' => NOT_FOUND
			]);
		if (Carbon::parse($user->updated_at)->addMinutes(1)->isPast()) {
			User::where('token', $token)->update(['token' => '']);
			return response()->json([
				'message' => 'This password reset token is invalid.',
				'code' => NOT_FOUND 
			]);
		}
		return response()->json($user);
	}

	public function resetPassword(Request $request)
	{
		$token= getallheaders()['token'];
		$user= $this->user->getUserByToken($token);
		$passwordNew= $request->passwordNew;
		$reset= $this->user->resetPassword($user->email, $passwordNew);
		if($reset == true){
			return response()->json([
				'message' => 'password changed success',
				'code' => Response::HTTP_OK 
			]);
		}
	}

	public function getUserdata(Request $request)
	{
		if($request->isMethod('get')){
			$token= getallheaders()['token'];
			$user= $this->user->getUserByToken($token);
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

	public function genToken()
	{
		return bin2hex(random_bytes(64));
	}

	public function logout()
	{
		$token= getallheaders()['token'];
		$this->user->deleteToken($token);
		return response()->json([
			'code' => Response::HTTP_OK,
			'message'  => LOGOUT_SUCCESS
		]);

	}

	public function editProfile(Request $request)
	{
		$token= getallheaders()['token'];
		$user= $this->user->getUserByToken($token);
		$data= $this->user->editProfile($user->id,$request->all());
		if($data){
			return response()->json([
				'code' => Response::HTTP_OK,
				'message'  => 'Edit success'
			]);
		}

	}

	//api change password
	public function changePassword(Request $request)
	{
		$token= getallheaders()['token'];
		$user= $this->user->getUserByToken($token);
		$data= $request->all();

		if( isset($data['oldPassword']) && !empty($data['oldPassword'])) {
			$check= Auth::attempt([
				'id' => $user->id,
				'password' => $data['oldPassword']]);
			if($check){
				$this->user->changePassword($user->id, $data['newPassword']);
				return response()->json([
					'code' => Response::HTTP_OK,
					'message'  => 'change success'
				]);
			}else{
				return response()->json([
					'code' => CODE_ERROR_VALID,
					'message'  => 'password not valid'
				]);
			}

		}else{
			return response()->json([
				'code' => ERROR_VALIDATE,
				'message' => 'not empty'
			]);
		}

	}

	//api send feedback
	public function sendFeedback(Request $request)
	{
		$token= getallheaders()['token'];
		$user= $this->user->getUserByToken($token);		
		$content= $request->content;
		$user->notify(new Feedback($content));  
		return response()->json([
			'code' => Response::HTTP_OK,
			'message' => 'send mail success'
		]);
	}

}
