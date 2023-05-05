<?php

namespace App\Http\Controllers;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use App\Models\Post;

class PortfolioController extends Controller
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
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

    public function index()
    {
        $category = $this->categoryRepository->firstOrFail(1);
        $categories = Category::where(['parent_id' => 1, 'status' => 1])
            ->orWhere('id', 1)
            ->get();

        return view('frontend/page/portfolio', [
            'category' => $category,
            'categories' => $categories,
            'posts' => Post::where('status', 1)->get(),
        ]);
    }
}
