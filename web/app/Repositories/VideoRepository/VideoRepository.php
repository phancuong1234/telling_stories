<?php

namespace App\Repositories\VideoRepository;
use App\Model\Video;
use App\Repositories\VideoRepository\VideoRepositoryInterface;
use DB;
class VideoRepository implements VideoRepositoryInterface
{
	public function insert(array $data, $id_story)
	{
		//dd($id_story->id);
		DB::beginTransaction();
		try {
			$record = new Video;
			$record->path = $data['video'];
			$record->story_id = $id_story->id;
			$record->save();
			DB::commit();
			return true;
		} catch (Exception $e) {
			DB::rollBack();
			return false;
		}
	}
	public function getVideoByStoryId($story_id)
	{
		$video= Video::where('story_id','=',$story_id)->get();
		return $video;
	}
}