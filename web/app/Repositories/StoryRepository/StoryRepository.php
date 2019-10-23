<?php

namespace App\Repositories\StoryRepository;
use App\Model\Story;
use App\Model\Question;
use App\Model\StoryAge;
use App\Model\Video;
use App\Repositories\StoryRepository\StoryRepositoryInterface;
use DB;
class StoryRepository implements StoryRepositoryInterface
{
	public function getAll()
	{
		$story= Story::all();
		return $story;
	}
	public function insert(array $data)
	{
		DB::beginTransaction();
		try {
			$story = new Story;
			$story->name = $data['name'];
			$story->photo = $data['photo'];
			$story->description = $data['description'];
			$story->list_question = $data['list_question'];
			$story->category_id = $data['category'];
			$story->save();

			DB::commit();
			return true;
		} catch (Exception $e) {
			DB::rollBack();
			return false;
		}
	}
	public function getStoryByIdLastest()
	{
		$id_story= Story::select('id')->orderBy('id', 'DESC')->first();
		return $id_story;
	}
	public function getStoryById($id)
	{
		$record= Story::where('id','=',$id)->first();
		return $record;
	}
	public function updateStoryById($id,array $data)
	{
		dd(json_encode($data['list_question_update']));
		DB::beginTransaction();
		try {
			$story= Story::find($id);
			$story->name = $data['name'];
			$story->photo = $data['photo'];
			$story->description = $data['description'];
			$story->category_id = $data['category'];
			$story->list_question = $data['list_question_update'];
			
			$story->save();
			DB::commit();
			return true;
		} catch (Exception $e) {
			DB::rollBack();
			return false;
		}
	}
	public function deleteUserWithID($id)
	{
		$result = User::find($id);
		if ($result) {
			$result->delete();
			return true;
		}
		return false;
	}

	public function getStoryNew()
	{
		$dataStoryNew= Story::select('id', 'name', 'photo', 'description')
		->orderBy('created_at', 'desc')
		->take(10)
		->get();
		return $dataStoryNew;
	}

	public function getStoryPopularity()
	{
		$dataStoryPopularity= Story::orderBy('views', 'desc')
		->take(10)
		->get();
		return $dataStoryPopularity;
	}

	public function getStoryNewAll()
	{
		$dataStoryNewAll= Story::select('id', 'name', 'photo', 'description')
		->orderBy('created_at', 'desc')
		->get();
		return $dataStoryNewAll;
	}

	public function getStoryPopularityAll()
	{
		$dataStoryPopularityAll= Story::orderBy('views', 'desc')
		->get();
		return $dataStoryPopularityAll;
	}
	public function getStoryDetail($id)
	{
		$dataStoryDetail= Story::where('id','=',$id)
		->get();
		return $dataStoryDetail;
	}
}