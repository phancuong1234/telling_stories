<?php

namespace App\Repositories\UserRepository;
use App\Model\User;
use App\Repositories\UserRepository\UserRepositoryInterface;
use DB;
class UserRepository implements UserRepositoryInterface
{
	public function getAll()
	{
		$user= User::where('delete_flg','=',DELETE_FALSE)->get();
		return $user;
	}
	public function checkExistEmail($email)
	{
		$user= User::where('email','=',$email)
		->where('delete_flg','=',DELETE_FALSE)
		->first();
		if(isset($user)){
			return false;
		}else{
			return true;
		}
	}
	public function insert(array $data)
	{
		DB::beginTransaction();
		try {
			$record = new User;
			$record->name = $data['name'];
			$record->email = $data['email'];
			$record->password = bcrypt($data['password']);
			$record->address = $data['address'];
			$record->gender = $data['gender'];
			$record->birthday = $data['birthday'];
			$record->avatar = $data['avatar'];
			$record->role_id = $data['role_id'];
			$record->save();
			DB::commit();
			return true;
		} catch (Exception $e) {
			DB::rollBack();
			return false;
		}
	}
	public function getUserById($id)
	{
		$record= User::where('id','=',$id)
		->where('delete_flg','=',DELETE_FALSE)->get()
		->first();
		return $record;
	}
	public function updateUserById($id,array $data)
	{
		DB::beginTransaction();
		try {
			$record= User::find($id);
			$record->name = $data['name'];
			$record->email = $data['email'];
			$record->address = $data['address'];
			$record->gender = $data['gender'];
			$record->birthday = $data['birthday'];
			$record->avatar = $data['avatar'];
			$record->role_id = $data['role_id'];
			$record->save();
			DB::commit();
			return true;
		} catch (Exception $e) {
			DB::rollBack();
			return false;
		}
	}
	public function deleteUserWithID($id)
	{
		$user= User::where('id','=',$id)->update(['delete_flg' => DELETE_TRUE]);
	}
	public function changeState($id, $state)
	{
		if($state == STATE_BLOCK){
			User::where('id','=',$id)->update(['state' => STATE_ACTIVE]);
		}
		if($state == STATE_ACTIVE){
			User::where('id','=',$id)->update(['state' => STATE_BLOCK]);
		}
	}
}