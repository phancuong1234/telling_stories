<?php

namespace App\Repositories\CategoryRepository;

interface CategoryRepositoryInterface
{
    public function getAll();

    public function create($data);

    public function getCategoryById($id);

    public function updateCategoryById($id,$data);
    
    public function deleteCategoryWithID($id);
}