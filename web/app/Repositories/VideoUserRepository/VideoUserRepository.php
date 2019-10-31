<?php

namespace App\Repositories\VideoUserRepository;
use App\Model\VideoUser;
use App\Repositories\VideoUserRepository\VideoUserRepositoryInterface;
use DB;
class VideoUserRepository implements VideoUserRepositoryInterface
{
	public function getCountVideo($user_id)
	{
		$count= VideoUser::select('user_id', DB::raw('count(*)'))->groupBy('user_id')
		->join('stories','stories.id','=','videos_user.story_id')
		->join('users','users.id','=','videos_user.user_id')
		->where('user_id',$user_id)
		->where('stories.delete_flg',DELETE_FALSE)
		->where('videos_user.delete_flg',DELETE_FALSE)
		->where('users.delete_flg',DELETE_FALSE)
		->where('videos_user.display_flg',DISPLAY)
		->get();
		return $count;
	}

	public function getRankingVideoUser()
	{
		$dataRankingVideoUser= VideoUser::join('stories','stories.id','=','videos_user.story_id')
		->join('users','users.id','=','videos_user.user_id')
		->select('videos_user.id as video_user_id','videos_user.path','videos_user.point','stories.name','users.id as user_id','users.name as username')
		->orderBy('videos_user.point', 'desc')
		->where('stories.delete_flg',DELETE_FALSE)
		->where('videos_user.delete_flg',DELETE_FALSE)
		->where('users.delete_flg',DELETE_FALSE)
		->where('videos_user.display_flg',DISPLAY)
		->get();

		return $dataRankingVideoUser;
	}
}