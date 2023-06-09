<?php

namespace App\Repositories;

use App\Interfaces\PostRepositoryInterface;
use App\Models\Category;
use App\Models\Service;

class ServicesRepository implements PostRepositoryInterface
{
    public function list()
    {
        return Service::orderBy('updated_at', 'DESC')->get();
    }

    public function findById(int $postId)
    {
        return Service::query()->findOrFail($postId);
    }

    public function create(array $details)
    {
        return Service::create($details);
    }

    public function update(int $postId, array $details)
    {
        return Service::query()->where('id', $postId)->update($details);
    }

    public function delete(int $postId)
    {
        return Service::query()->where('id', $postId)->delete();
    }

}
