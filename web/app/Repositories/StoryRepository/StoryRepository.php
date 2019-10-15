<?php

namespace App\Repositories\StoryRepository;
use App\Model\Story;
use App\Repositories\StoryRepository\StoryRepositoryInterface;
use DB;
class StoryRepository implements StoryRepositoryInterface
{
	public function getAll()
	{
		$story= Story::all();
		return $story;
	}
	// public function insert(array $data)
	// {
	// 	DB::beginTransaction();
	// 	try {
	// 		$record = new User;
	// 		$record->name = $data['name'];
	// 		$record->email = $data['email'];
	// 		$record->password = bcrypt($data['password']);
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
	// public function getUserById($id)
	// {
	// 	$record= User::where('id','=',$id)->first();
	// 	return $record;
	// }
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