<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\VideoUserRepository\VideoUserRepositoryInterface;
use App\Repositories\UserRepository\UserRepositoryInterface;
use Illuminate\Http\Response;

class VideoUserController extends Controller
{
	protected $videoUser;
	protected $user;

	public function __construct(VideoUserRepositoryInterface $videoUser, UserRepositoryInterface $user)
	{
		$this->videoUser = $videoUser;
		$this->user = $user;
	}

	public function getCountVideo(Request $request)
	{
		if($request->isMethod('get')){
			$count= $this->videoUser->getCountVideo($request->id);
			return response()->json([
				'code' => Response::HTTP_OK,
				'data'  => $count,
			]);
		} else {
			return response()->json([
				'error' => MESSAGE_ERROR_METHOD,
				'code'  => CODE_ERROR_METHOD
			]);
		}
	}

	public function getRankingVideoUser(Request $request)
	{

		if($request->isMethod('get')){
			$dataRankingVideoUser= $this->videoUser->getRankingVideoUser();
			return response()->json([
				'code' => Response::HTTP_OK,
				'data'  => $dataRankingVideoUser,
			]);
		} else {
			return response()->json([
				'error' => MESSAGE_ERROR_METHOD,
				'code'  => CODE_ERROR_METHOD
			]);
		}
	}

	//api create video user
	public function createVideo(Request $request)
	{
		$token= getallheaders()['token'];
		$user= $this->user->getUserByToken($token);
		$dataCreate= $this->videoUser->createVideo($user->id, $request->story_id, $request->path);

		return response()->json([
			'code' => Response::HTTP_OK,
			'data'  => $dataCreate,
		]);
	}

}
