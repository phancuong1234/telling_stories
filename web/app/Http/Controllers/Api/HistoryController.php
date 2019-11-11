<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\HistoryRepository\HistoryRepositoryInterface;
use App\Repositories\UserRepository\UserRepositoryInterface;
use Illuminate\Http\Response;

class HistoryController extends Controller
{

	protected $history;
	protected $user;

	public function __construct(HistoryRepositoryInterface $history, UserRepositoryInterface $user)
	{
		$this->history = $history;
		$this->user = $user;
	}
    	//api get history
	public function getStoryHistoryView(Request $request)
	{
		if($request->isMethod('get')){
			$token= getallheaders()['token'];
			$user= $this->user->getUserByToken($token);
			$dataStoryHistoryView= $this->history->getStoryHistoryView($user->id);
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
