<?php

namespace App\Repositories\ResultTestRepository;
use App\Model\ResultTest;
use App\Model\User;
use App\Repositories\ResultTestRepository\ResultTestRepositoryInterface;
use DB;
class ResultTestRepository implements ResultTestRepositoryInterface
{
	public function getPointByUser($user_id)
	{
		$point= ResultTest::select('user_id', DB::raw('sum(results_test.point) as total_point'))->groupBy('user_id')
		->join('stories','stories.id','=','results_test.story_id')
		->where('user_id',$user_id)
		->where('stories.delete_flg',DELETE_FALSE)
		->where('results_test.delete_flg',DELETE_FALSE)
		->get();
		return $point;
	}

	public function getRankingResultTest()
	{
		$dataRankingResultTest= [];
		$dataRankingResultTest= ResultTest::select('user_id', DB::raw('sum(results_test.point) as total_point'))->groupBy('user_id')
		->join('stories','stories.id','=','results_test.story_id')
		->join('users','users.id','=','results_test.user_id')
		->orderBy('total_point','desc')
		->where('stories.delete_flg',DELETE_FALSE)
		->where('results_test.delete_flg',DELETE_FALSE)
		->where('users.delete_flg',DELETE_FALSE)
		->get()->toArray();

		foreach ($dataRankingResultTest as $key => $value) {
			$user= User::select('name','avatar')
			->where('id',$value['user_id'])
			->where('delete_flg',DELETE_FALSE)
			->first();
			$dataRankingResultTest[$key]['name']= $user['name'];
			$dataRankingResultTest[$key]['avatar']= $user['avatar'];
		}

		return $dataRankingResultTest;
	}
}