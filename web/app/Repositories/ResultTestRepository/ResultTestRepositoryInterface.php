<?php

namespace App\Repositories\ResultTestRepository;

interface ResultTestRepositoryInterface
{
    public function getPointByUser($user_id);

    public function getRankingResultTest();

    public function getResultTest($user_id, $story_id);
}