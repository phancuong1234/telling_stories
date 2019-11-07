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
		$storyByPlaylist=[];
		foreach ($id as $key => $value) {
			$storyByPlaylist[$key]= Story::where('id',$value)
			->where('delete_flg',DELETE_FALSE)
			->get();
		}

		return $storyByPlaylist;
	}
}