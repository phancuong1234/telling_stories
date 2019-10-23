<?php

namespace App\Repositories\QuestionRepository;

interface QuestionRepositoryInterface
{
    public function insert(array $data);
    public function getID();
    public function getQuestionById(array $id);
}