<?php

namespace App\Repositories\FavoriteRepository;
use App\Model\Favorite;
use App\Repositories\FavoriteRepository\FavoriteRepositoryInterface;
use DB;
class FavoriteRepository implements FavoriteRepositoryInterface
{
	public function getStoryFavorite($id)
	{
		$dataStoryFavorite= Favorite::join('stories','favorites.story_id','=','stories.id')
		->select('stories.id','stories.photo','stories.name','stories.description')
		->where('user_id',$id)
		->where('favorites.delete_flg',DELETE_FALSE)
		->where('stories.delete_flg',DELETE_FALSE)
		->get();
		
		return $dataStoryFavorite;
	}

	public function addFavorite($story_id, $state, $user_id)
	{
		$check= Favorite::where('user_id',$user_id)->where('story_id',$user_id)->first();
		//dd($state);
		if($check){
			if($state == 0){
				Favorite::where('id','=',$check->id)->update(['delete_flg' => 1]);
			}
			if($state == 1){
				Favorite::where('id','=',$check->id)->update(['delete_flg' => 0]);
			}
		}
	}
}