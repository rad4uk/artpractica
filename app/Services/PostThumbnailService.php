<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\File;
use Intervention\Image\Image;
use App\Models\Post;

class PostThumbnailService
{
    const METHOD = 'fit';
    const DIR = 'size';

    public function addThumbnailInList(Collection $posts, string $size = '570x650'): array
    {
        $items = [];
        foreach ($posts as $key => $post){
            $items[$key]['id'] = $post->id;
            $items[$key]['title'] = $post->title;
            $items[$key]['description'] = $post->description;
            $items[$key]['slug'] = route('projects', $post->slug);
            $items[$key]['preview_image'] = route('thumbnail', [
                'dir' => 'size',
                'method' => 'fit',
                'size' => $size,
                'file' => File::basename($post->preview_image)
            ]);
        }


        return $items;
    }

}
