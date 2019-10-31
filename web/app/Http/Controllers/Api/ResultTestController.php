<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ResultTestRepository\ResultTestRepositoryInterface;
use Illuminate\Http\Response;

class ResultTestController extends Controller
{
	protected $resultTest;

	public function __construct(ResultTestRepositoryInterface $resultTest)
	{
		$this->resultTest = $resultTest;
	}

    public function getPointByUser(Request $request)
    {
    	if($request->isMethod('get')){
			/*$token= $request->bearerToken();
			$user = JWTAuth::toUser($token);*/
			$point= $this->resultTest->getPointByUser($request->id);
			return response()->json([
				'code' => Response::HTTP_OK,
				'data'  => $point,
			]);
		} else {
			return response()->json([
				'error' => MESSAGE_ERROR_METHOD,
				'code'  => CODE_ERROR_METHOD
			]);
		}
    }

    //api get ranking result test
    public function getRankingResultTest(Request $request)
    {
    	if($request->isMethod('get')){
			/*$token= $request->bearerToken();
			$user = JWTAuth::toUser($token);*/
			$dataRankingResultTest= $this->resultTest->getRankingResultTest();
			return response()->json([
				'code' => Response::HTTP_OK,
				'data'  => $dataRankingResultTest,
			]);
		} else {
			return response()->json([
				'error' => MESSAGE_ERROR_METHOD,
				'code'  => CODE_ERROR_METHOD
			]);
		}
    }
}
