<?php

namespace App\Repositories\AgeRepository;
use App\Model\Age;
use App\Repositories\AgeRepository\AgeRepositoryInterface;
use DB;
class AgeRepository implements AgeRepositoryInterface
{
	public function getAll()
	{
		$age= Age::all();
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
		$record= Age::where('id','=',$id)->first();
		return $record;
	}
	public function updateAgeById($id,$data)
	{
		DB::beginTransaction();
		try {
			$record= Age::find($id);
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
		$result = Age::find($id);
		if ($result) {
			$result->delete();
			return true;
		}
		return false;
	}
}