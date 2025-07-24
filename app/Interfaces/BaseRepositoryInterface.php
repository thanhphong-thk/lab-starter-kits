<?php

namespace App\Interfaces;

interface BaseRepositoryInterface
{
    public function getAll();
    public function create(array $data);

}
