<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository\CategoryRepositoryInterface;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
	protected $category;

	public function __construct(CategoryRepositoryInterface $category)
	{
		$this->category = $category;
	}

	public function getListCategory(Request $request)
	{
		if($request->isMethod('get')){
			$dataCategory= $this->category->getAll();
			return response()->json([
				'code'  => Response::HTTP_OK,
				'data' => $dataCategory,
			]);
		}else {
			return response()->json([
				'error' => MESSAGE_ERROR_METHOD,
				'code'  => CODE_ERROR_METHOD
			]);
		}
	}
}
