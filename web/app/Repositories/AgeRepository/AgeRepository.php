<?php

namespace App\Repositories\AgeRepository;
use App\Model\Age;
use App\Repositories\AgeRepository\AgeRepositoryInterface;
use DB;
class AgeRepository implements AgeRepositoryInterface
{
	public function getAll()
	{
		$age= Age::where('delete_flg',DELETE_FALSE)->get();
		return $age;
	}
	public function create($data)
	{
		DB::beginTransaction();
		try {
			$record = new Age;
			$record->age = $data;
			$record->save();
			DB::commit();
			return true;
		} catch (Exception $e) {
			DB::rollBack();
			return false;
		}
	}
	public function getAgeById($id)
	{
		$record= Age::where('id',$id)
		->where('delete_flg',DELETE_FALSE)
		->first();
		return $record;
	}
	public function updateAgeById($id, $data)
	{
		DB::beginTransaction();
		try {
			$record= Age::where('id',$id)
			->where('delete_flg',DELETE_FALSE)->first();
			$record->age = $data['age'];
			$record->save();
			DB::commit();
			return true;
		} catch (Exception $e) {
			DB::rollBack();
			return false;
		}
	}
	public function deleteAgeWithID($id)
	{
		return Age::where('id',$id)->update(['delete_flg' => DELETE_TRUE]);
	}
	public function checkExists($id)
	{
		$age= Age::where('delete_flg',DELETE_FALSE)
		->where('id',$id)
		->first();
		if($age){
			return true;
		}else{
			return false;
		}
	}
}