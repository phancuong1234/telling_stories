<?php

namespace App\Repositories\UserRepository;

interface UserRepositoryInterface
{
	public function getAll();
	public function insert(array $data);
	public function getUserById($id);
	public function updateUserById($id, array $data);
    public function deleteUserWithID($id);
}