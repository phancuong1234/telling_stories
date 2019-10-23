<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\StoryRepository\StoryRepositoryInterface;
use App\Repositories\CategoryRepository\CategoryRepositoryInterface;
use App\Repositories\AgeRepository\AgeRepositoryInterface;
use App\Repositories\QuestionRepository\QuestionRepositoryInterface;
use App\Repositories\StoryAgeRepository\StoryAgeRepositoryInterface;
use App\Repositories\VideoRepository\VideoRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class StoryController extends Controller
{
	protected $story;
	protected $category;
	protected $age;
	protected $question;
	protected $storyAge;
	protected $video;
	public function __construct(StoryRepositoryInterface $story, CategoryRepositoryInterface $category,AgeRepositoryInterface $age,QuestionRepositoryInterface $question, StoryAgeRepositoryInterface $storyAge, VideoRepositoryInterface $video)
	{
		$this->story = $story;
		$this->category = $category;
		$this->age = $age;
		$this->question = $question;
		$this->storyAge = $storyAge;
		$this->video = $video;
	}

	//api get info story new
	public function getStoryNew(Request $request)
	{

		if($request->isMethod('get')){
			$dataStoryNew= $this->story->getStoryNew();
			return response()->json([
				'code'  => Response::HTTP_OK,
				'data' => $dataStoryNew,
			]);
		}else {
			return response()->json([
				'error' => MESSAGE_ERROR_METHOD,
				'code'  => CODE_ERROR_METHOD
			]);
		}
	}

	//api get story popularity
	public function getStoryPopularity(Request $request)
	{
		if($request->isMethod('get')){
			$dataStoryPopularity= $this->story->getStoryPopularity();
			return response()->json([
				'code'  => Response::HTTP_OK,
				'data' => $dataStoryPopularity,
			]);
		}else {
			return response()->json([
				'error' => MESSAGE_ERROR_METHOD,
				'code'  => CODE_ERROR_METHOD
			]);
		}
	}

	//api get all story new
	public function getStoryNewAll(Request $request)
	{
		if($request->isMethod('get')){
			$dataStoryNew= $this->story->getStoryNewAll();
			return response()->json([
				'code'  => Response::HTTP_OK,
				'data' => $dataStoryNew,
			]);
		}else {
			return response()->json([
				'error' => MESSAGE_ERROR_METHOD,
				'code'  => CODE_ERROR_METHOD
			]);
		}
	}

	//api get all popularity
	public function getStoryPopularityAll(Request $request)
	{
		if($request->isMethod('get')){
			$dataStoryPopularityAll= $this->story->getStoryPopularityAll();
			return response()->json([
				'code'  => Response::HTTP_OK,
				'data' => $dataStoryPopularity,
			]);
		}else {
			return response()->json([
				'error' => MESSAGE_ERROR_METHOD,
				'code'  => CODE_ERROR_METHOD
			]);
		}
	}

	//api detail story
	public function getStoryDetail(Request $request)
	{
		if($request->isMethod('get')){
			$dataStoryDetail= $this->story->getStoryDetail($request->id);
			return response()->json([
				'code'  => Response::HTTP_OK,
				'data' => $dataStoryDetail,
			]);
		}else{
			return response()->json([
				'error' => MESSAGE_ERROR_METHOD,
				'code'  => CODE_ERROR_METHOD
			]);
		}
	}
}