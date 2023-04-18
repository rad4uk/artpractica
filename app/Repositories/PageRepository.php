<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\PageRepositoryInterface;
use App\Models\Page;

class PageRepository implements PageRepositoryInterface
{

    public function list()
    {
        return Page::all();
    }

    public function findById(int $pageId)
    {
        return Page::where('id', $pageId)->first();
    }

    public function create(array $details)
    {
        return Page::create($details);
    }

    public function update(int $pageId, array $details)
    {
        return Page::query()->where('id', $pageId)->update($details);
    }

    public function delete(int $pageId)
    {
        // TODO: Implement delete() method.
    }
}
