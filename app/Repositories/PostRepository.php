<?php

namespace App\Repositories;

use App\Interfaces\PostRepositoryInterface;
use App\Models\Category;
use App\Models\Post;

class PostRepository implements PostRepositoryInterface
{

    public function list()
    {
        return Post::orderBy('updated_at', 'DESC')->get();
    }

    public function additionalPostsPublishList(int $excludedPostId = 0)
    {
        $post = Post::where('status', 1)->orderBy('updated_at', 'DESC');
        if ($excludedPostId){
            $post->where('id', '!=', $excludedPostId);
        }
        return $post;
    }



    public function findById(int $postId)
    {
        return Post::query()->findOrFail($postId);
    }

    public function create(array $details)
    {
        return Post::create($details);
    }

    public function update(int $postId, array $details)
    {
        return Post::query()->where('id', $postId)->update($details);
    }

    public function delete(int $postId)
    {
        return Post::query()->where('id', $postId)->delete();
    }

    public function getCategory()
    {
        return Post::belongsTo(Category::class);
    }

    public function getOffsetPosts(int $offset, int $limit, int $catId)
    {
        return Post::where(['status' => 1, 'category_id' => $catId])
            ->offset($offset)->limit($limit)->get();
    }

    public function updateOrCreate(string $slug, array $details)
    {
        return Post::updateOrCreate(
            ['slug' => $slug],
            $details
        );
    }
}
