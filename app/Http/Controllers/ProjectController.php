<?php

namespace App\Http\Controllers;

use App\Interfaces\PostRepositoryInterface;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(string $slug): View|Factory
    {
        $project = Post::where('slug', $slug)->firstOrFail();
        $categories = Category::where(['parent_id' => 1, 'status' => 1])
            ->orWhere(['id' => 1, 'status' => 1])
            ->get();

        $apartmentImages = [];
        foreach (json_decode($project->apartment_images) as $imageName){
            $apartmentImages[] = $project->getFullImagePath($imageName);
        }
        $additionalPostsData = [];
        $additionalPosts = $project->additionalPostsToMany()->get();
        foreach ($additionalPosts as $key => $post){
            $additionalPostsData[$key]['title'] = $post->title;
            $additionalPostsData[$key]['square'] = $post->square;
            $additionalPostsData[$key]['preview_image'] = $project->getFullImagePath($post->preview_image);
            $additionalPostsData[$key]['slug'] = route('projects', $post->slug);
        }

        $categoriesData = [];
        foreach ($categories as $key => $categoryItem){
            $categoriesData[$key]['id'] = $categoryItem->id;
            $categoriesData[$key]['title'] = $categoryItem->title;
            $categoriesData[$key]['slug'] = route('categories', $categoryItem->slug);
        }

        return view('frontend/project/project', [
            'post' => $project,
            'apartmentImages' => $apartmentImages,
            'additionalPostsData' => $additionalPostsData,
            'categories' => $categoriesData,
            'body' => json_decode($project->body)->frontend
        ]);
    }
}
