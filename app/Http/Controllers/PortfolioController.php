<?php

namespace App\Http\Controllers;

use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\PostRepositoryInterface;
use App\Services\PostThumbnailService;

class PortfolioController extends Controller
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly PostRepositoryInterface $postRepository,
        private readonly PostThumbnailService $postThumbnailService
    )
    {

    }
    public function index()
    {
        $category = $this->categoryRepository->firstOrFail(1);
//        $posts = $this->postThumbnailService->addThumbnailInList($category->posts, '570X650');
        $posts = [];
        foreach ($category->posts as $key => $post){
            $posts[$key]['id'] = $post->id;
            $posts[$key]['title'] = $post->title;
            $posts[$key]['slug'] = route('projects', $post->slug);
            $posts[$key]['preview_image'] = asset($post->previewImagePath . $post->preview_image);
        }
        return view('frontend/page/portfolio', [
            'category' => $category,
            'posts' => $posts
        ]);
    }

    public function getNextPosts(int $offset)
    {
        $posts = $this->postThumbnailService->addThumbnailInList(
            $this->postRepository->getOffsetPosts($offset, 10, 6)
            , '570X650');
        return response()->json(
            $posts
        );
    }
}
