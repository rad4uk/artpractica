<?php

namespace App\Interfaces;

interface PostRepositoryInterface
{
    public function list();
    public function findById(int $postId);
    public function create(array $details);
    public function update(int $postId, array $details);
    public function delete(int $postId);
}
