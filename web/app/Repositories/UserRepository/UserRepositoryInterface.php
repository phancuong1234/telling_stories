<?php

namespace App\Repositories\UserRepository;

interface UserRepositoryInterface
{
	public function getAll();

	public function changeState($id,$state);

	public function checkExistEmail($email);

	public function createUser(array $data);

	public function insert(array $data);

	public function getUserById($id);

	public function updateUserById($id, array $data);

    public function deleteUserWithID($id);

    public function updateToken($id,$token);

    public function deleteToken($token);

    public function getUserByToken($token);

    public function editProfile($user_id, array $data);

    public function changePassword($user_id, $data);

    public function resetPassword($email, $passwordNew);


}