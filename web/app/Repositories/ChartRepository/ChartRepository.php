<?php

namespace App\Repositories\ChartRepository;
use App\Model\User;
use App\Model\Story;
use App\Model\VideoUser;
use App\Repositories\ChartRepository\ChartRepositoryInterface;
use DB;
class ChartRepository implements ChartRepositoryInterface
{
	public function getDataChart($id, $type)
	{
		$year_current= now()->format('Y');
		$month_current= now()->format('m');
		$weekStartDate = now()->startOfWeek();
		$weekEndDate = now()->endOfWeek();

		//if($month_current > 1){
		switch ($id) {
			case 0:
			if($type == 0){
				$count= User::select(DB::raw('DAYNAME(created_at) as date'), DB::raw('count(*) as count'))
				->groupby('date')
				->whereBetween('created_at', array($weekStartDate, $weekEndDate))
				->where('delete_flg', DELETE_FALSE)
				->where('role_id', USER)
				->get()->toArray();
			}

			if($type == 1){
				$count= User::select(DB::raw('YEAR(created_at) as year, MONTH(created_at) month'), DB::raw('count(*) as count'))
				->groupby('year','month')
				->whereYear('created_at', $year_current)
				->where('delete_flg', DELETE_FALSE)
				->where('role_id', USER)
				->get()->toArray();
			}
			if($type == 2){
				$count= User::select(DB::raw('YEAR(created_at) as year'), DB::raw('count(*) as count'))
				->groupby('year')
				->whereYear('created_at','<', $year_current + 1)
				->whereYear('created_at','>', $year_current - 10 )
				->where('delete_flg', DELETE_FALSE)
				->where('role_id', USER)
				->get()->toArray();
			}
			
			break;
			case 1:
			if($type == 0){
				$count= Story::select(DB::raw('DAYNAME(created_at) as date'), DB::raw('count(*) as count'))
				->groupby('date')
				->whereBetween('created_at', array($weekStartDate, $weekEndDate))
				->where('delete_flg', DELETE_FALSE)
				->get()->toArray();
			}

			if($type == 1){
				$count= Story::select(DB::raw('YEAR(created_at) as year, MONTH(created_at) month'), DB::raw('count(*) as count'))
				->groupby('year','month')
				->whereYear('created_at', $year_current)
				->where('delete_flg', DELETE_FALSE)
				->get()->toArray();
			}
			if($type == 2){
				$count= Story::select(DB::raw('YEAR(created_at) as year'), DB::raw('count(*) as count'))
				->groupby('year')
				->whereYear('created_at','<', $year_current + 1)
				->whereYear('created_at','>', $year_current - 10 )
				->where('delete_flg', DELETE_FALSE)
				->get()->toArray();
			}

			break;
			case 2:
			if($type == 0){
				$count= VideoUser::select(DB::raw('DAYNAME(created_at) as date'), DB::raw('count(*) as count'))
				->groupby('date')
				->whereBetween('created_at', array($weekStartDate, $weekEndDate))
				->where('delete_flg', DELETE_FALSE)
				->get()->toArray();
			}
			if($type == 1){
				$count= VideoUser::select(DB::raw('YEAR(created_at) as year, MONTH(created_at) month'), DB::raw('count(*) as count'))
				->groupby('year','month')
				->whereYear('created_at', $year_current)
				->where('delete_flg', DELETE_FALSE)
				->get()->toArray();
			}
			if($type == 2){
				$count= VideoUser::select(DB::raw('YEAR(created_at) as year'), DB::raw('count(*) as count'))
				->groupby('year')
				->whereYear('created_at','<', $year_current + 1)
				->whereYear('created_at','>', $year_current - 10 )
				->where('delete_flg', DELETE_FALSE)
				->get()->toArray();
			}
			break;
			default:
			if($type == 0){
				$count= Story::select(DB::raw('DAYNAME(created_at) as date'), DB::raw('sum(views) as count'))
				->groupby('date')
				->whereBetween('created_at', array($weekStartDate, $weekEndDate))
				->where('delete_flg', DELETE_FALSE)
				->get()->toArray();
			}
			if($type == 1){
				$count= Story::select(DB::raw('YEAR(created_at) as year, MONTH(created_at) month'), DB::raw('sum(views) as count'))
				->groupby('year','month')
				->whereYear('created_at', $year_current)
				->where('delete_flg', DELETE_FALSE)
				->get()->toArray();
			}
			if($type == 2){
				$count= Story::select(DB::raw('YEAR(created_at) as year'),  DB::raw('sum(views) as count'))
				->groupby('year')
				->whereYear('created_at','<', $year_current + 1)
				->whereYear('created_at','>', $year_current - 10 )
				->where('delete_flg', DELETE_FALSE)
				->get()->toArray();
			}
			break;
		}
		
		//}
		return $count;
	}
}