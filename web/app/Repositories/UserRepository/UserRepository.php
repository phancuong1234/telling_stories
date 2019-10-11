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
}