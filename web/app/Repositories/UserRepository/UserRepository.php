<?php

namespace App\Repositories\UserRepository;
use App\Model\User;
use App\Repositories\UserRepository\UserRepositoryInterface;
use DB;
class UserRepository implements UserRepositoryInterface
{
	public function getAll()
	{
		$user= User::all();
		return $user;
	}
	public function insert(array $data)
	{
		DB::beginTransaction();
		try {
			$record = new User;
			$record->name = $data['name'];
			$record->email = $data['email'];
			$record->password = $data['password'];
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
}