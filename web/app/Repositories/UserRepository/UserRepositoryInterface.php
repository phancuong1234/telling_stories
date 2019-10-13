<?php

namespace App\Repositories\UserRepository;

interface UserRepositoryInterface
{
	public function getAll();
	public function insert(array $data);
}