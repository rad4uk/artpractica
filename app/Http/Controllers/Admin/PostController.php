<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostStoreRequest;
use App\Interfaces\PostRepositoryInterface;
use App\Models\Category;
use App\Models\Post;
use App\Services\Admin\PostService;
use App\Services\ProjectService;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class PostController extends Controller
{
    public function __construct(
        private readonly PostRepositoryInterface $postRepository,
        private readonly PostService             $postService,
        private readonly ProjectService          $projectService
    )
    {

    }

    public function index(): View|Factory
    {
        return view('adminlte.post.index', [
            'posts' => $this->postRepository->list()
        ]);
    }

    public function preview(int $postId): Response|ResponseFactory|View|Factory
    {
        $project = Post::where('id', $postId)->firstOrFail();
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

    public function store(PostStoreRequest $request): Response|ResponseFactory
    {
        $requestData = $request->request->all();
        $allFilesData = $request->files->all();

        $formData = $requestData['formData'];
        $filesData = $allFilesData['formData'];

        $widgetData = $this->postService->matchingRequestData($requestData, $allFilesData);
        $objectsWidgetData = $this->postService->setWidgetsData($widgetData['data']);

        try {
            $postData = $this->postService->setPostData(
                $formData,
                $filesData,
                json_encode(
                    array_merge($objectsWidgetData)
                )
            );
        } catch (\RuntimeException $exception) {
            return response($exception->getMessage(), 422);
        }
        $post = $this->postRepository->create($postData);
        if (isset($formData['additionalPosts']) && count($formData['additionalPosts']) > 0) {
            $post->additionalPostsToMany()->attach($formData['additionalPosts']);
        }

        return response('', 201);
    }

    public function create(): Response|ResponseFactory|View|Factory
    {
        $categories = Category::where('parent_id', '=', 1)->get();

        $posts = $this->postRepository->additionalPostsPublishList()->get();

        return view('adminlte.post.create', [
            'categories' => $categories,
            'posts' => $posts,
        ]);
    }

    public function edit(int $postId): View|Factory
    {
        $categories = Category::where('parent_id', '=', 1)->get();

        $post = $this->postRepository->findById($postId);

        $posts = $this->postRepository->additionalPostsPublishList($postId)->get();

        return view('adminlte.post.edit', [
            'categories' => $categories,
            'post' => $post,
            'posts' => $posts,
            'additionalPosts' => $post->additionalPostsToMany()->get(),
            'body' => json_decode($post->body)->admin,
        ]);
    }

    public function update(Request $request, int $postId): Response|ResponseFactory
    {
        $post = $this->postRepository->findById($postId);
        $requestData = $request->request->all();
        $allFilesData = $request->files->all();

        $formData = $requestData['formData'];
        $filesData = $allFilesData['formData'];

        $widgetData = $this->postService->matchingRequestData($requestData, $allFilesData);
        $objectsWidgetData = $this->postService->setWidgetsData($widgetData['data']);

        try {
            $postData = $this->postService->setPostData(
                $formData,
                $filesData,
                json_encode($objectsWidgetData)
            );
        } catch (\RuntimeException $exception) {
            return response($exception->getMessage(), 422);
        }

        $this->postRepository->update($postId, $postData);
        if (isset($formData['additionalPosts']) && count($formData['additionalPosts']) > 0) {
            $post->additionalPostsToMany()->sync($formData['additionalPosts']);
        }

        return response('', 201);
    }

    public function delete(int $postId): Response|ResponseFactory
    {
        $this->postRepository->delete($postId);

        return response('', 204);
    }

    public function updateSort(Request $request): Response|ResponseFactory
    {
        $posts = $request->request->all();

        foreach ($posts as $post){
            Post::where('id', $post['id'])->update(['sort' => $post['sort']]);
        }

        return response('', 204);
    }

    public function updateCategorySort(Request $request): Response|ResponseFactory
    {
        $posts = $request->request->all();

        foreach ($posts as $post){
            Post::where('id', $post['id'])->update(['category_sort' => $post['category_sort']]);
        }

        return response('', 204);
    }
}
