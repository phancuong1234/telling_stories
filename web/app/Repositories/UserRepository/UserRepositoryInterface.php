<?php

namespace App\Repositories\UserRepository;

interface UserRepositoryInterface
{
	public function getAll();
	public function changeState($id,$state);
	public function checkExistEmail($email);
	public function insert(array $data);
	public function getUserById($id);
	public function updateUserById($id, array $data);
    public function deleteUserWithID($id);

    public function updateToken($id,$token);



}