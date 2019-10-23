<?php

namespace App\Repositories\VideoRepository;

interface VideoRepositoryInterface
{
    public function insert(array $data, $id_story);
    public function getVideoByStoryId($story_id);
}