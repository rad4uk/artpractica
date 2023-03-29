<?php

namespace App\Interfaces;

interface CategoryRepositoryInterface
{
    public function list();
    public function findById(int $catId);
    public function create(array $details);
    public function update(int $catId, array $details);
    public function delete(int $cattId);
}
