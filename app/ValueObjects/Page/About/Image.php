<?php

namespace App\ValueObjects\Page\About;

use Illuminate\Http\UploadedFile;

class Image
{
    public function __construct(
        private readonly UploadedFile $file
    )
    {
    }

    public function getFileOriginalName(): string
    {
        return $this->file->getClientOriginalName();
    }

}
