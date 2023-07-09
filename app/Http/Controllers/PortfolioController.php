<?php

namespace App\Http\Controllers;

use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\PostRepositoryInterface;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PortfolioController extends Controller
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly PostRepositoryInterface $postRepository
    )
    {

    }

    public function categories(string $categorySlug)
    {
        $category = Category::where(['slug' => $categorySlug, 'status' => 1])
            ->where('id','!=', 1)
            ->firstOrFail();
        $categories = Category::where(['parent_id' => 1, 'status' => 1])
            ->orWhere('id', 1)
            ->get();

        return view('frontend/page/portfolio', [
            'category' => $category,
            'categories' => $categories,
            'posts' => $category->posts,
        ]);
    }

    public function index(): View|Factory
    {
        $category = $this->categoryRepository->firstOrFail(1);
        $categories = Category::where(['parent_id' => 1, 'status' => 1])
            ->orWhere('id', 1)
            ->get();

        return view('frontend/page/portfolio', [
            'category' => $category,
            'categories' => $categories,
            'posts' => Post::where('status', 1)->limit(2)->get(),
        ]);
    }

    public function getNextPosts(int $categoryId, int $offset): \Illuminate\Http\JsonResponse
    {
        if ($categoryId === 1){
            $posts = $this->postRepository->getPortfolioOffsetPosts($offset, 2);
        }else{
            $posts = $this->postRepository->getOffsetPosts($offset, 2, $categoryId);
        }
        return response()->json($posts);
    }

}
