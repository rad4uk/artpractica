<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ThumbnailController extends Controller
{
    public function index(
        string $dir,
        string $size,
        string $method,
        string $file
    ): BinaryFileResponse
    {
        abort_if(
            !in_array($size, config('thumbnail.allowed_sizes', [])),
            403,
            'Size not allowed'
        );

        $storage = Storage::disk('images');
        $newPath = "$dir/$size/$method";
        $finallyPath = "$newPath/$file";

        if(!$storage->exists($newPath)){
            $storage->makeDirectory($newPath);
        }

        if(!$storage->exists($finallyPath)){

            [$w, $h] = explode('x', $size);

            $image = Image::make($storage->path($file));

            $image->{$method}($w, $h);

            $image->save($storage->path($finallyPath));
        }

        return response()->file($storage->path($finallyPath));
    }


}
