<?php

namespace App\Traits\Models;

use Illuminate\Support\Facades\File;

trait HasThumbnail
{
    abstract protected function thumbnailDir(): string;

    public function makeThumbnail(string $fileName, string $size, string $method = 'fit'): string
    {
        return route('thumbnail', [
            'dir' => $this->thumbnailDir(),
            'size' => $size,
            'method' => $method,
            'file' => $fileName
        ]);
    }

    protected function thumbnailColumn(): string
    {
        return 'thumbnail';
    }
}
