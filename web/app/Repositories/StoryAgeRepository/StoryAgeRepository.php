<?php

namespace App\Repositories\StoryAgeRepository;
use App\Model\StoryAge;
use App\Repositories\StoryAgeRepository\StoryAgeRepositoryInterface;
use DB;
class StoryAgeRepository implements StoryAgeRepositoryInterface
{
	public function insert(array $data)
	{
		//dd($data['story_id']['id']);
		DB::beginTransaction();
		try {
			$story_age = new Story_age;
			$story_age->age_id = $data['age_id'];
			$story_age->story_id = $data['story_id']['id'];
			$story_age->save();
			DB::commit();
			return true;
		} catch (Exception $e) {
			DB::rollBack();
			return false;
		}
	}
	public function getStoryAgeById($id)
	{
		$story_age= StoryAge::where('story_id','=',$id)->get();
		//dd($story_age[0]);
		return $story_age;
	}
}