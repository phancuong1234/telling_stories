<?php

namespace App\Repositories\VideoUserRepository;

interface VideoUserRepositoryInterface
{
	public function getCountVideo($user_id);

    public function getRankingVideoUser();
}