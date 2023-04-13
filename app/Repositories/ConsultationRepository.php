<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Consultation;

class ConsultationRepository implements CategoryRepositoryInterface
{

    public function list()
    {
        // TODO: Implement list() method.
    }

    public function findById(int $catId)
    {
        // TODO: Implement findById() method.
    }

    public function create(array $details)
    {
        return Consultation::create($details);
    }

    public function update(int $catId, array $details)
    {
        // TODO: Implement update() method.
    }

    public function delete(int $cattId)
    {
        // TODO: Implement delete() method.
    }
}
