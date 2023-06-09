<?php

namespace App\Services;

use App\Models\Post;

class ProjectService
{
    public function setSliderImagesData(Post $post): array
    {
        $data = [];
        $body = json_decode($post->body)->frontend;
        foreach ($body as $key => $item){
            if (isset($item->file)){
                $data[] = $post->getFullImagePath($item->file);
            }
            if (isset($item->files) && count($item->files) > 0){
                foreach ($item->files as $filesKey => $file){
                    $data[] = $post->getFullImagePath($file);
                }
            }
        }
        return $data;
    }
    public function setFullImagePathForBody(Post $post): array
    {
        $body = json_decode($post->body)->frontend;
        foreach ($body as $key => $item){
            if (isset($item->file)){
                $body[$key]->file = $post->getFullImagePath($item->file);
            }
            if (isset($item->files) && count($item->files) > 0){
                foreach ($item->files as $filesKey => $file){
                    $body[$key]->files[$filesKey] = $post->getFullImagePath($file);
                }
            }
        }

        return $body;
    }
}
