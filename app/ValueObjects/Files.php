<?php

namespace App\ValueObjects;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class Files implements \JsonSerializable
{
    private array $files;

    public function setFile(UploadedFile $file): self
    {
        $this->files[] = $file;

        return $this;
    }

    public function getFiles(): array
    {
        return $this->files;
    }


    public function jsonSerialize(): array
    {
        return array_map(static function (UploadedFile $file) {
            return $file->getClientOriginalName();
        }, $this->files);
    }
}
