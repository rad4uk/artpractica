<?php

namespace App\Services;

class PostService
{
    private string $title;
    private string $description;
    private ?int $category_id;
    private string $slug;
    private int $status;
    private string $filePath;

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
     * @return int|null
     */
    public function getCategoryId(): ?int
    {
        return $this->category_id;
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

    /**
     * @return int
     */
    public function getFilePath(): string

    {
        return $this->status;
    }

    /**
     * @param string $title
     * @param string $description
     * @param int|null $category_id
     * @param string $slug
     */
    public function __construct(
        string $title,
        string $description,
        ?int $category_id,
        string $slug,
        int $status,
        string $filesPath
    )
    {
        $this->title = $title;
        $this->description = $description;
        $this->category_id = $category_id;
        $this->slug = $slug;
        $this->status = $status;
        $this->filePath = $filesPath;
    }


    public function getDetails()
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'slug' => $this->slug,
            'status' => $this->status,
            'preview_image' => $this->filePath
        ];
    }

}
