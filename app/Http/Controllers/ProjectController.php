<?php

namespace App\Http\Controllers;

use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(
        private readonly PostRepositoryInterface $postRepository
    )
    {
    }

    public function index(string $slug)
    {
        $project = Post::where('slug', $slug)->firstOrFail();
        $apartmentImages = [];
        foreach (json_decode($project->apartment_images) as $imageName){
            $apartmentImages[] = $project->getFullImagePath($imageName);
        }
        $additionalPostsData = [];
        $additionalPosts = $project->additionalPostsToMany()->get();
        foreach ($additionalPosts as $key => $post){
            $additionalPostsData[$key]['title'] = $post->title;
            $additionalPostsData[$key]['preview_image'] = $project->getFullImagePath($post->preview_image);
            $additionalPostsData[$key]['slug'] = route('projects', $post->slug);
        }
        return view('frontend/project/project', [
            'post' => $project,
            'apartmentImages' => $apartmentImages,
            'additionalPostsData' => $additionalPostsData,
            'body' => json_decode($project->body)->frontend
        ]);
    }
    public function index2()
    {
        return view('frontend/page/project2');
    }
    public function index3()
    {
        return view('frontend/page/project3');
    }
    public function index4()
    {
        return view('frontend/page/project4');
    }
}
