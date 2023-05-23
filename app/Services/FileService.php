<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileService
{
    public function saveFile(UploadedFile $file, string $filePath): string
    {
        $storage = Storage::disk('public');
        $fullFilePath = $filePath . DIRECTORY_SEPARATOR . $file->getClientOriginalName();
        if ($storage->exists($fullFilePath)){
            return $file->getClientOriginalName();
        }
        $uuid = Str::uuid()->toString();
        $fileName = $uuid . '.' . $file->getClientOriginalExtension();
        Storage::disk('public')->putFileAs(
            $filePath,
            $file,
            $fileName
        );
        return $fileName;
    }
}
