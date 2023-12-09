<?php

namespace App\Interfaces;

interface PostRepositoryInterface
{
    public function list();

    public function findById(int $postId);

    public function create(array $details);

    public function update(int $postId, array $details);

    public function delete(int $postId);

    public function findBy(array $condition, array $orderBy = null, int $limit = null, int $offset = null);

    public function getOffsetPosts(int $offset, int $limit, int $catId);

    public function getPortfolioOffsetPosts(int $offset, int $limit);
}
