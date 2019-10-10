<?php

namespace App\Repositories\CategoryRepository;
use App\Model\Category;
use App\Repositories\CategoryRepository\CategoryRepositoryInterface;
use DB;
class CategoryRepository implements CategoryRepositoryInterface
{
	public function getAll()
	{
		$category= Category::all();
		return $category;
	}
	public function create($data)
	{
		DB::beginTransaction();
		try {
			$record = new Category;
			$record->name = $data;
			$record->save();
			DB::commit();
			return true;
		} catch (Exception $e) {
			DB::rollBack();
			return false;
		}
	}
	public function getCategoryById($id)
	{
		$record= Category::where('id','=',$id)->first();
		return $record;
	}
	public function updateCategoryById($id,$data)
	{
		DB::beginTransaction();
		try {
			$record= Category::find($id);
			$record->name = $data['name'];
			$record->save();
			DB::commit();
			return true;
		} catch (Exception $e) {
			DB::rollBack();
			return false;
		}
	}
	public function deleteCategoryWithID($id)
	{
		$result = Category::find($id);
		if ($result) {
			$result->delete();
			return true;
		}
		return false;
	}
}