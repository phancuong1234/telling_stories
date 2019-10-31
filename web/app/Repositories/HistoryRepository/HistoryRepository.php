<?php

namespace App\Repositories\HistoryRepository;
use App\Model\History;
use App\Repositories\HistoryRepository\HistoryRepositoryInterface;
use DB;
class HistoryRepository implements HistoryRepositoryInterface
{
	public function getStoryHistoryView($id)
	{
		$dataStoryHistoryView= History::join('stories','stories.id','=','histories.story_id')
		->select('stories.id','stories.photo','stories.name','stories.description')
		->where('user_id',$id)
		->where('histories.delete_flg',DELETE_FALSE)
		->where('stories.delete_flg',DELETE_FALSE)
		->get();
		
		return $dataStoryHistoryView;
	}
}