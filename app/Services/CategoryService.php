<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    private ?int $parentId;
    private string $title;
    private string $description;
    private string $slug;
    private int $status;

    /**
     * @param int|null $parentId
     * @param string $title
     * @param string $description
     * @param string $slug
     * @param int $status
     */
    public function __construct(?int $parentId, string $title, string $description, string $slug, int $status)
    {
        $this->parentId = $parentId;
        $this->title = $title;
        $this->description = $description;
        $this->slug = $slug;
        $this->status = $status;
    }

    /**
     * @return int|null
     */
    public function getParentId(): ?int
    {
        return $this->parentId;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    public function getDetails()
    {
        return [
            'parent_id' => $this->parentId,
            'title' => $this->title,
            'description' => $this->description,
            'slug' => $this->slug,
            'status' => $this->status
        ];
    }

    public static function getFullSlug(Category $category): string
    {
        $buf = $category;

        $slug = [$buf->slug];
        while ($buf->parentRecursive !== null) {
            $buf = $buf->parentRecursive;
            $slug[] = $buf->slug;
        }
        return env('APP_URL') . '/' . implode('/',array_reverse($slug)) . '/';
    }
}
