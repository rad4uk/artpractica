<?php

namespace App\Http\Controllers;

use App\Interfaces\PostRepositoryInterface;
use App\Models\Category;
use App\Models\Post;
use App\Services\ProjectService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(
        private readonly ProjectService $projectService
    )
    {
    }

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
        $additionalPosts = $project->additionalPostsToMany()->get();

        $body = $this->projectService->setFullImagePathForBody($project);
        $sliderImagesData = $this->projectService->setSliderImagesData($project);

        return view('frontend/project/project', [
            'post' => $project,
            'apartmentImages' => $apartmentImages,
            'additionalPostsData' => $additionalPosts,
            'categories' => $categories,
            'body' => $body,
            'sliderImagesData' => $sliderImagesData
        ]);
    }
}
