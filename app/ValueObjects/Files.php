<?php

namespace App\ValueObjects;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class Files implements \JsonSerializable
{
    private array $files = [];

    public function setFile(string $fileName): self
    {
        $this->files[] = $fileName;

        return $this;
    }

    public function getFiles(): array
    {
        return $this->files;
    }


    public function jsonSerialize(): array
    {
        return $this->files;
    }
}
