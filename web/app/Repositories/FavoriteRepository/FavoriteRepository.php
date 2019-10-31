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
}