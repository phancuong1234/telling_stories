<?php

namespace App\Repositories\CommentRepository;

interface CommentRepositoryInterface
{
    public function createComment($data, $user_id);
}