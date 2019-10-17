<?php

namespace App\Repositories\AgeRepository;

interface AgeRepositoryInterface
{
    public function getAll();

    public function create($data);

    public function getAgeById($id);

    public function updateAgeById($id,$data);
    
    public function deleteAgeWithID($id);
}