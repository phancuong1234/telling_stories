<?php

namespace App\Repositories\VideoUserRepository;

interface VideoUserRepositoryInterface
{
	public function getCountVideo($user_id);

    public function getRankingVideoUser();

    public function createVideo($user_id, $story_id, $path);
}