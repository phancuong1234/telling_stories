<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\HistoryRepository\HistoryRepositoryInterface;
use Illuminate\Http\Response;

class HistoryController extends Controller
{

	protected $history;

	public function __construct(HistoryRepositoryInterface $history)
	{
		$this->history = $history;
	}
    	//api get history
	public function getStoryHistoryView(Request $request)
	{
		if($request->isMethod('get')){
			/*$token= $request->bearerToken();
			$user = JWTAuth::toUser($token);*/
			$dataStoryHistoryView= $this->history->getStoryHistoryView($request->id);
			return response()->json([
				'code'  => Response::HTTP_OK,
				'data' => $dataStoryHistoryView,
			]);
		}else{
			return response()->json([
				'error' => MESSAGE_ERROR_METHOD,
				'code'  => CODE_ERROR_METHOD
			]);
		}
	}
}
