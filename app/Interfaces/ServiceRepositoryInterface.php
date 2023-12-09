<?php

namespace App\Interfaces;

interface ServiceRepositoryInterface
{
    public function list();
    public function findById(int $serviceId);
    public function create(array $details);
    public function update(int $serviceId, array $details);
    public function delete(int $serviceId);
    public function findByOne(array $condition);
    public function findBy(array $condition, array $orderBy = null, int $limit = null, int $offset = null);
}
