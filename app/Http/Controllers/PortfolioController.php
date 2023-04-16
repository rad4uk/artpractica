<?php

namespace App\Http\Controllers;

use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\PostRepositoryInterface;
use App\Models\Category;
use App\Models\Post;
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

    public function categories(string $categorySlug)
    {
        $category = Category::where(['slug' => $categorySlug, 'status' => 1])
            ->where('id','!=', 1)
            ->firstOrFail();
        $categories = Category::where(['parent_id' => 1, 'status' => 1])
            ->orWhere(['id' => 1, 'status' => 1])
            ->get();
        $posts = [];
        foreach ($category->posts as $key => $post){
            $posts[$key]['id'] = $post->id;
            $posts[$key]['title'] = $post->title;
            $posts[$key]['slug'] = route('projects', $post->slug);
            $posts[$key]['preview_image'] = asset($post->previewImagePath . $post->preview_image);
        }

        $categoriesData = [];
        foreach ($categories as $key => $categoryItem){
            $categoriesData[$key]['id'] = $categoryItem->id;
            $categoriesData[$key]['title'] = $categoryItem->title;
            $categoriesData[$key]['slug'] = route('categories', $categoryItem->slug);
        }

        return view('frontend/page/portfolio', [
            'category' => $category,
            'categories' => $categoriesData,
            'posts' => $posts,
        ]);
    }

    public function index()
    {
        $category = $this->categoryRepository->firstOrFail(1);
//        $posts = $this->postThumbnailService->addThumbnailInList($category->posts, '570X650');
        $categories = Category::where(['parent_id' => 1, 'status' => 1])
            ->orWhere(['id' => 1, 'status' => 1])
            ->get();
        $publishPosts = Post::where('status', 1)->get();

        $posts = [];
        foreach ($publishPosts as $key => $post){
            $posts[$key]['id'] = $post->id;
            $posts[$key]['title'] = $post->title;
            $posts[$key]['square'] = $post->square;
            $posts[$key]['slug'] = route('projects', $post->slug);
            $posts[$key]['preview_image'] = asset($post->previewImagePath . $post->preview_image);
        }

        $categoriesData = [];
        foreach ($categories as $key => $categoryItem){
            $categoriesData[$key]['id'] = $categoryItem->id;
            $categoriesData[$key]['title'] = $categoryItem->title;
            $categoriesData[$key]['slug'] = route('categories', $categoryItem->slug);
        }

        return view('frontend/page/portfolio', [
            'category' => $category,
            'categories' => $categoriesData,
            'posts' => $posts,
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
