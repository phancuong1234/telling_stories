<?php

namespace App\Repositories\StoryRepository;
use App\Model\Story;
use App\Model\Question;
use App\Model\Story_age;
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
	// public function updateUserById($id,array $data)
	// {
	// 	DB::beginTransaction();
	// 	try {
	// 		$record= User::find($id);
	// 		$record->name = $data['name'];
	// 		$record->email = $data['email'];
	// 		$record->address = $data['address'];
	// 		$record->gender = $data['gender'];
	// 		$record->birthday = $data['birthday'];
	// 		$record->avatar = $data['avatar'];
	// 		$record->role_id = $data['role_id'];
	// 		$record->save();
	// 		DB::commit();
	// 		return true;
	// 	} catch (Exception $e) {
	// 		DB::rollBack();
	// 		return false;
	// 	}
	// }
	// public function deleteUserWithID($id)
	// {
	// 	$result = User::find($id);
	// 	if ($result) {
	// 		$result->delete();
	// 		return true;
	// 	}
	// 	return false;
	// }
}