<?php

namespace App\Repositories\ResultTestRepository;

interface ResultTestRepositoryInterface
{
    public function getPointByUser($user_id);

    public function getRankingResultTest();
}