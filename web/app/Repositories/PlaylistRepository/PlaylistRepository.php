<?php

namespace App\Repositories\PlaylistRepository;
use App\Model\Playlist;
use App\Model\Story;
use App\Repositories\PlaylistRepository\PlaylistRepositoryInterface;
use DB;
class PlaylistRepository implements PlaylistRepositoryInterface
{
	public function getPlaylists($id)
	{
		$playlist= Playlist::where('user_id',$id)
		->where('delete_flg',DELETE_FALSE)
		->get();

		return $playlist;
	}

	public function getStoryPlaylist($playlist_id)
	{
		$storyIdByPlaylist= Playlist::select('list_story')->where('id',$playlist_id)
		->where('delete_flg',DELETE_FALSE)
		->first();
		$id= json_decode($storyIdByPlaylist->list_story);
		$storyByPlaylist= [];
		if($id){
			$storyByPlaylist=[];
			$storyByPlaylist= Story::whereIn('id',$id)
			->where('delete_flg',DELETE_FALSE)
			->get();
		}	
		return $storyByPlaylist;
	}

	public function createPlaylist($user_id, $name)
	{
		return Playlist::create([
			'name' => $name,
			'user_id' => $user_id
		]);
	}

	public function addStoryPlaylist($data)
	{
		$listCurrent= Playlist::where('id',$data['playlist_id'])->where('delete_flg',DELETE_FALSE)->first();
		$story_id_add= intval($data['story_id']);

		if(empty($listCurrent->list_story)){
			$playlist= Playlist::where('id',$data['playlist_id'])->update([
				'list_story' => json_encode(array($story_id_add)),
			]);
			return 1;
		}else{
			$listStoryCurrent= json_decode($listCurrent->list_story);

			if (in_array($data['story_id'], $listStoryCurrent))
			{
				return 0;
			} else {
				$listUpdate= array_unshift($listStoryCurrent, $story_id_add);
				$playlist= Playlist::where('id',$data['playlist_id'])->update([
					'list_story' => json_encode($listStoryCurrent),
				]);
				return 1;
			}
		}
		
	}

}