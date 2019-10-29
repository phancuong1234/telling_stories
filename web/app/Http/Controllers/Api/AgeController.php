<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\AgeRepository\AgeRepositoryInterface;
use Illuminate\Http\Response;

class AgeController extends Controller
{
	protected $age;

	public function __construct(AgeRepositoryInterface $age)
	{
		$this->age = $age;
	}

	public function getListAge(Request $request)
	{
		if($request->isMethod('get')){
			$dataAge= $this->age->getAll();
			return response()->json([
				'code'  => Response::HTTP_OK,
				'data' => $dataAge,
			]);
		}else {
			return response()->json([
				'error' => MESSAGE_ERROR_METHOD,
				'code'  => CODE_ERROR_METHOD
			]);
		}
	}
}
