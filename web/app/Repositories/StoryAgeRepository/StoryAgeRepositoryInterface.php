<?php

namespace App\Repositories\StoryAgeRepository;

interface StoryAgeRepositoryInterface
{
    public function insert(array $data);

    public function getStoryAgeById($id);
}