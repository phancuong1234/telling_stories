<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\StoryRepository\StoryRepositoryInterface;
use App\Repositories\CategoryRepository\CategoryRepositoryInterface;
use App\Repositories\AgeRepository\AgeRepositoryInterface;
use App\Repositories\QuestionRepository\QuestionRepositoryInterface;
use App\Repositories\StoryAgeRepository\StoryAgeRepositoryInterface;
use App\Repositories\VideoRepository\VideoRepositoryInterface;

class StoryController extends Controller
{
	protected $story;
	protected $category;
	protected $age;
	public function __construct(StoryRepositoryInterface $story, CategoryRepositoryInterface $category,AgeRepositoryInterface $age,QuestionRepositoryInterface $question, StoryAgeRepositoryInterface $story_age, VideoRepositoryInterface $video)
	{
		$this->story = $story;
		$this->category = $category;
		$this->age = $age;
		$this->question = $question;
		$this->story_age = $story_age;
		$this->video = $video;
	}
	public function index()
	{
		$list= $this->story->getAll();
		return view('admin.story.index',compact('list'));
	}
	public function create()
	{
		$list_category= $this->category->getAll();
		$ages= $this->age->getAll();
		return view('admin.story.create',compact(['list_category','ages']));
	}
	public function store(Request $request)
	{
		/*dd($request->all());*/
		$data=
		[
			'name' => $request->name,
			'photo' => $request->photo,
			'description' => $request->description,
			'list_question' => $request->list_question,
			'category' =>$request->category,
			'age' => $request->age,
			'video' => $request->video,
			'views' => $request->views
		];
		$this->story->insert($data);
		return redirect('admin/story')->with(['success' => CREATE_SUCCESS]);
	}
	public function detail($id)
	{
		$checkId= $this->story->checkExists($id);
		if($checkId){

			$record= $this->story->getStoryById($id);
			$video= $this->video->getVideoByStoryId($id);

			$array_age= [];
			$story_age= $this->story_age->getStoryAgeById($id);
			foreach ($story_age as $key => $value) {
				$age= $this->age->getAgeById($value->age_id);
				array_push($array_age,$age);
			}
			//get list age
			$list_age= $this->age->getAll();
			$list_question= json_decode($record->list_question);
		 	//get list_question
			$question= $this->question->getQuestionById($list_question);

			return view('admin.story.detail',compact(['record','video','array_age','list_age','question']));
		}else {
			abort(404);
		}
		
	}
	public function edit($id)
	{
		$checkId= $this->story->checkExists($id);
		if($checkId){

			$record= $this->story->getStoryById($id);
			$video= $this->video->getVideoByStoryId($id);

			$array_age= [];
			$story_age= $this->story_age->getStoryAgeById($id);
			foreach ($story_age as $key => $value) {
				$age= $this->age->getAgeById($value->age_id);
				array_push($array_age,$age);
			}
			//get list age
			$list_age= $this->age->getAll();
			$list_question= json_decode($record->list_question);
		 	//get list_question
			$question= $this->question->getQuestionById($list_question);
			//get list category
			$list_category= $this->category->getAll();
			return view('admin.story.edit',compact(['record','video','array_age','list_age','question','list_category']));
		}else {
			abort(404);
		}
		return view('admin.story.edit',compact(['record','record_category','story_age','array_age','video','question','list_age']));
	}
	public function update(Request $request, $id)
	{
		$data= [
			'name' => $request->name,
			'photo' => $request->photo,
			'description' => $request->description,
			'category' =>$request->category,
			'list_question_update' => $request->list_question_update,
			'age' => $request->age,
			'video' => $request->video_exists,
			'views' => $request->views,
			'list_question_new' => $request->list_question_new
		];
		$this->story->updateStoryById($id,$data);
		return redirect('admin/story')->with(['success' => UPDATE_SUCCESS]);;
	}
	public function destroy($id)
	{
		try {
			$this->story->deleteStoryWithID($id);
			return redirect('admin/story')->with(['success' => DELETE_SUCCESS]);
		} catch ( \Exception $e ){
			return redirect('admin/story')->with(['error' => DELETE_FAIL]);
		}
	}
}
