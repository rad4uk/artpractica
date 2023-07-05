<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileService
{
    public function saveFile(UploadedFile $file, string $filePath): string
    {
        $storage = Storage::disk('public');
        $fullFilePath = $filePath . DIRECTORY_SEPARATOR . $file->getClientOriginalName();

        if ($storage->exists($fullFilePath)){
            ImageOptimizer::optimize(
                $storage->path($filePath . DIRECTORY_SEPARATOR . $file->getClientOriginalName())
            );
            return $file->getClientOriginalName();
        }
        $uuid = Str::uuid()->toString();
        $fileName = $uuid . '.' . $file->getClientOriginalExtension();
        $storage->putFileAs(
            $filePath,
            $file,
            $fileName
        );

        ImageOptimizer::optimize(
            $storage->path($filePath . DIRECTORY_SEPARATOR . $fileName)
        );
        return $fileName;
    }
}
