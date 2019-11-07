<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\FavoriteRepository\FavoriteRepositoryInterface;
use Illuminate\Http\Response;

class FavoriteController extends Controller
{
	protected $favorite;

	public function __construct(FavoriteRepositoryInterface $favorite)
	{
		$this->favorite = $favorite;
	}
    	//api get story favorite
	public function getStoryFavorite(Request $request)
	{
		if($request->isMethod('get')){
			$dataStoryFavorite= $this->favorite->getStoryFavorite($request->id);
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
			$this->favorite->addFavorite($request->story_id, $request->state, $request->user_id);
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
