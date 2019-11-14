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
		if(empty($user)){
			return false;
		}else{
			return true;
		}
	}

	public function createUser($data)
	{
		return User::create([
			'email' => $data['email'],
			'name' => $data['name'],
			'password' => bcrypt($data['password'])
		]);
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
			//$record->avatar = $data['avatar'];
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

	public function updateToken($id, $token)
	{
		return User::where('id','=',$id)->update(['token' => $token]);
	}

	public function deleteToken($token)
	{
		return User::where('token','=',$token)->update(['token' => null]);
	}
	public function getUserByToken($token)
	{
		$user= User::where('token',$token)->where('delete_flg',0)->first();
		return $user;
	}

	public function editProfile($user_id, array $data)
	{
		if($data['name']){
			return User::where('id','=',$user_id)->update(['name' => $data['name']]);
		}
		if($data['address']){
			return User::where('id','=',$user_id)->update(['address' => $data['address']]);
		}
		if($data['gender']){
			return User::where('id','=',$user_id)->update(['gender' => $data['gender']]);
		}
		if($data['birthday']){
			return User::where('id','=',$user_id)->update(['birthday' => $data['birthday']]);
		}
		if($data['avatar']){
			return User::where('id','=',$user_id)->update(['avatar' => $data['avatar']]);
		}
	}

	public function changePassword($user_id, $newPassword)
	{
		$user= User::where('id','=',$user_id)
		->where('delete_flg','=',DELETE_FALSE)->get()
		->first();
		$user->password= bcrypt($newPassword);
		$user->save();
		return $user;
	}

	public function resetPassword($email, $passwordNew)
	{
		$user = User::where('email', $email)->firstOrFail();
        $updatePasswordUser = $user->update(['password' => bcrypt($passwordNew)]);
        
        return $updatePasswordUser;
	}

}