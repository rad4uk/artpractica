<?php

namespace App\Interfaces;

interface PageRepositoryInterface
{
    public function list();
    public function findById(int $pageId);
    public function create(array $details);
    public function update(int $pageId, array $details);
    public function delete(int $pageId);
}
