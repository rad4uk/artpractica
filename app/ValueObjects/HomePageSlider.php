<?php

namespace App\ValueObjects;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class HomePageSlider implements \JsonSerializable
{
    private string $title;
    private array $files;

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function setFile(UploadedFile $file): self
    {
        $this->files[] = $file->getClientOriginalName();

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'title' => $this->title,
            'files' => $this->files
        ];
    }
}
