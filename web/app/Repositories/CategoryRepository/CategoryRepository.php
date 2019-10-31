<?php

namespace App\Repositories\CategoryRepository;
use App\Model\Category;
use App\Repositories\CategoryRepository\CategoryRepositoryInterface;
use DB;
class CategoryRepository implements CategoryRepositoryInterface
{
	public function getAll()
	{
		$category= Category::where('delete_flg',DELETE_FALSE)->get();
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
		$record= Category::where('id',$id)
		->where('delete_flg',DELETE_FALSE)
		->first();
		return $record;
	}
	public function updateCategoryById($id,$data)
	{
		DB::beginTransaction();
		try {
			$record= Category::where('delete_flg',DELETE_FALSE)
			->where('id',$id)->first();
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
		return Category::where('id',$id)->update(['delete_flg' => DELETE_TRUE]);
	}
	public function checkExists($id)
	{
		$user= Category::where('delete_flg',DELETE_FALSE)
		->where('id',$id)
		->first();
		if($user){
			return true;
		}else{
			return false;
		}
	}
}