<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\FavoriteRepository\FavoriteRepositoryInterface;
use App\Repositories\UserRepository\UserRepositoryInterface;
use Illuminate\Http\Response;

class FavoriteController extends Controller
{
	protected $favorite;
	protected $user;

	public function __construct(FavoriteRepositoryInterface $favorite, UserRepositoryInterface $user)
	{
		$this->favorite = $favorite;
		$this->user = $user;
	}
    	//api get story favorite
	public function getStoryFavorite(Request $request)
	{
		if($request->isMethod('get')){
			$token= getallheaders()['token'];
			$user= $this->user->getUserByToken($token);
			$dataStoryFavorite= $this->favorite->getStoryFavorite($user->id);
			return response()->json([
				'code'  => Response::HTTP_OK,
				'data' => $dataStoryFavorite,
			]);
		}else{
			return response()->json([
				'error' => MESSAGE_ERROR_METHOD,
				'code'  => CODE_ERROR_METHOD
			]);
		}
	}

	//api add favorite
	public function addFavorite(Request $request)
	{
		if($request->isMethod('post')){
			$token= getallheaders()['token'];
			$user= $this->user->getUserByToken($token);
			$this->favorite->addFavorite($request->story_id, $request->state, $user->id);
			return response()->json([
				'code'  => Response::HTTP_OK,
			]);
		}else{
			return response()->json([
				'error' => MESSAGE_ERROR_METHOD,
				'code'  => CODE_ERROR_METHOD
			]);
		}
	}
}
