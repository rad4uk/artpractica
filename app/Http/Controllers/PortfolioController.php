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
        $category = $this->categoryRepository->firstOrFail(6);
//        dd($category->posts[0]->makeThumbnail('345x320','fit'));
        $posts = $this->postThumbnailService->addThumbnailInList($category->posts, '570X650');
//        dd($category, $posts);
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
