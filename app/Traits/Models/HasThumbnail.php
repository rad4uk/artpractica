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
            'file' => $fileName
//            'file' => File::basename($this->{$this->thumbnailColumn()})
        ]);
    }

    protected function thumbnailColumn(): string
    {
        return 'thumbnail';
    }
}
