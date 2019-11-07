<?php

namespace App\Repositories\ChartRepository;

interface ChartRepositoryInterface
{
    public function getDataChart($id, $type);
}