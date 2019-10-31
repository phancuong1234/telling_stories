<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\VideoUserRepository\VideoUserRepositoryInterface;
use Illuminate\Http\Response;

class VideoUserController extends Controller
{
	protected $videoUser;

	public function __construct(VideoUserRepositoryInterface $videoUser)
	{
		$this->videoUser = $videoUser;
	}

	public function getCountVideo(Request $request)
	{
		if($request->isMethod('get')){
			/*$token= $request->bearerToken();
			$user = JWTAuth::toUser($token);*/
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
			/*$token= $request->bearerToken();
			$user = JWTAuth::toUser($token);*/
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

}
