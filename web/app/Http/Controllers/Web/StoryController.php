<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\StoryRepository\StoryRepositoryInterface;
use App\Repositories\CategoryRepository\CategoryRepositoryInterface;
use App\Repositories\AgeRepository\AgeRepositoryInterface;
use App\Repositories\QuestionRepository\QuestionRepositoryInterface;
use App\Repositories\StoryAgeRepository\StoryAgeRepositoryInterface;

class StoryController extends Controller
{
	protected $story;
	protected $category;
	protected $age;
	public function __construct(StoryRepositoryInterface $story, CategoryRepositoryInterface $category,AgeRepositoryInterface $age,QuestionRepositoryInterface $question, StoryAgeRepositoryInterface $story_age)
	{
		$this->story = $story;
		$this->category = $category;
		$this->age = $age;
		$this->question = $question;
		$this->story_age = $story_age;
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
		$count= count($request->list_question);
		$list_id_question= [];
		for ($i= 0; $i < $count; $i++) {
			$data=
			[
				'question' => $request->list_question[$i][0],
				'answer_true' => $request->list_question[$i][1],
				'answer_false_1' => $request->list_question[$i][2],
				'answer_false_2' => $request->list_question[$i][3],
				'answer_false_3' => $request->list_question[$i][4],
			];
			$this->question->insert($data);
			$id= $this->question->getID();
			array_push($list_id_question,$id->id);
		}

		$data1=
		[
			'name' => $request->name,
			'photo' => $request->photo,
			'description' => $request->description,
			'list_question' => json_encode($list_id_question),
			'category' =>$request->category,
			'age' => $request->age
		];
		$this->story->insert($data1);
		$id_story= $this->story->getStoryByIdLastest();

		for ($i=0; $i < count($request->age); $i++) {
			$data2=
			[
				'age_id' => $request->age[$i],
				'story_id' => $id_story
			];
			$this->story_age->insert($data2);
		}
		return redirect('admin/story')->with(['success' => CREATE_SUCCESS]);
	}
	public function detail($id)
	{
		$array_age= [];
		$record= $this->story->getStoryById($id);
		//get category story
		$category_id= $record->category_id;
		$record_category= $this->category->getCategoryById($category_id);
		//get ages story
		$story_id= $record->id;
		$story_age= $this->story_age->getStoryAgeById($story_id);
		foreach ($story_age as $key => $value) {
			$age= $this->age->getAgeById($value->age_id);
			array_push($array_age,$age);
		}
		return view('admin.story.detail',compact(['record','record_category','story_age','array_age']));
	}
	public function edit($id)
	{
		$array_age= [];
		$record= $this->story->getStoryById($id);
		//get category story
		$category_id= $record->category_id;
		$record_category= $this->category->getCategoryById($category_id);
		//get ages story
		$story_id= $record->id;
		$story_age= $this->story_age->getStoryAgeById($story_id);
		foreach ($story_age as $key => $value) {
			$age= $this->age->getAgeById($value->age_id);
			array_push($array_age,$age);
		}
		return view('admin.story.edit',compact(['record','record_category','story_age','array_age']));
	}
	public function update(Request $request, $id)
	{
		$data= [
			'name' => $request->name,
			'email' => $request->email,
			'address' => $request->address,
			'gender' =>$request->gender,
			'birthday' => $request->birthday,
			'avatar' => $request->avatar,
			'role_id' => $request->role
		];
		$this->user->updateUserById($id,$data);
		return redirect('admin/user')->with(['success' => UPDATE_SUCCESS]);;
	}
	// public function destroy($id)
	// {
	// 	try {
	// 		$this->user->deleteUserWithID($id);
	// 		return redirect('admin/user')->with(['success' => DELETE_SUCCESS]);
	// 	} catch ( \Exception $e ){
	// 		return redirect('admin/user')->with(['error' => DELETE_FAIL]);
	// 	}
	// }
}
