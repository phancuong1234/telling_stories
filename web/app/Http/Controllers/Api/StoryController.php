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
	//api get top slide
	public function getTopSlide(Request $request)
	{
		if($request->isMethod('get')){
			/*$token= $request->bearerToken();
			$user= JWTAuth::toUser($token);*/
			/*if(){

			} else {

			}*/
			$topSlide= $this->story->getTopSlide();
			return response()->json([
				'code'  => Response::HTTP_OK,
				'data' => $topSlide,
			]);
		} else {
			return response()->json([
				'error' => MESSAGE_ERROR_METHOD,
				'code'  => CODE_ERROR_METHOD,
			]);
		}
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

    //api get list story recommend
	public function getStoryRecommend(Request $request)
	{
		if($request->isMethod('get')){
			$dataStoryRecommend= $this->story->getStoryRecommend();
			return response()->json([
				'code'  => Response::HTTP_OK,
				'data' => $dataStoryRecommend,
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
			$dataStoryDetail= $this->story->getStoryDetail($request->id, $request->user_id);
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

	//api story by category
	public function getStoryByCategory(Request $request)
	{
		if($request->isMethod('get')){
			$dataStoryByCategory= $this->story->getStoryByCategory($request->id);
			return response()->json([
				'code'  => Response::HTTP_OK,
				'data' => $dataStoryByCategory,
			]);
		}else{
			return response()->json([
				'error' => MESSAGE_ERROR_METHOD,
				'code'  => CODE_ERROR_METHOD
			]);
		}
	}

	//api get story by age
	public function getStoryByAge(Request $request)
	{
		if($request->isMethod('get')){
			$dataStoryByAge= $this->story->getStoryByAge($request->age_id);
			return response()->json([
				'code'  => Response::HTTP_OK,
				'data' => $dataStoryByAge,
			]);
		}else{
			return response()->json([
				'error' => MESSAGE_ERROR_METHOD,
				'code'  => CODE_ERROR_METHOD
			]);
		}
	}


	//api get story download
	public function getStoryDownload(Request $request)
	{
		if($request->isMethod('get')){
			$dataStoryDownload= $this->story->getStoryDownload($request->id);
			return response()->json([
				'code'  => Response::HTTP_OK,
				'data' => $dataStoryDownload,
			]);
		}else{
			return response()->json([
				'error' => MESSAGE_ERROR_METHOD,
				'code'  => CODE_ERROR_METHOD
			]);
		}
	}

	//api get story popularity by week
	public function getStoryPopularityWeek(Request $request)
	{
		if($request->isMethod('get')){
			$dataStoryPopularityWeek= $this->story->getStoryPopularityWeek();
			return response()->json([
				'code'  => Response::HTTP_OK,
				'data' => $dataStoryPopularityWeek,
			]);
		}else{
			return response()->json([
				'error' => MESSAGE_ERROR_METHOD,
				'code' => CODE_ERROR_METHOD
			]);
		}
	}

	//api get story popularity by month
	public function getStoryPopularityMonth(Request $request)
	{
		if($request->isMethod('get')){
			$dataStoryPopularityMonth= $this->story->getStoryPopularityMonth();
			return response()->json([
				'code'  => Response::HTTP_OK,
				'data' => $dataStoryPopularityMonth,
			]);
		}else{
			return response()->json([
				'error' => MESSAGE_ERROR_METHOD,
				'code' => CODE_ERROR_METHOD
			]);
		}
	}

}
