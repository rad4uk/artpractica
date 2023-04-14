<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\WidgetNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostCreateRequest;
use App\Http\Requests\Admin\PostNewRequest;
use App\Interfaces\PostRepositoryInterface;
use App\Models\Category;
use App\Models\Post;
use App\Repositories\PostRepository;
use App\Services\Admin\PostService;
use Carbon\Carbon;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PostController extends Controller
{
    public function __construct(
        private readonly PostRepositoryInterface $postRepository,
        private readonly PostService             $postService
    )
    {

    }

    public function index()
    {
        return view('adminlte.post.index', [
            'posts' => $this->postRepository->list()
        ]);
    }

    public function preview(int $postId)
    {
        $project = Post::where('id', $postId)->firstOrFail();

        return view('frontend/project/project', [
            'post' => $project,
            'body' => json_decode($project->body)->frontend
        ]);
    }

    public function create(Request $request): Response|ResponseFactory|View|Factory
    {
        $categories = Category::with('childrenRecursive')
            ->whereNull('parent_id')
            ->get();
        $posts = $this->postRepository->additionalPostsPublishList()->get();
        if ($request->isMethod('POST')) {
            $requestData = $request->request->all();
            $allFilesData = $request->files->all();

            $formData = $requestData['formData'];
            $filesData = $allFilesData['formData'];

            $adminWidgetData = $this->postService->matchingRequestData($requestData, $allFilesData);
            $frontendWidgetData = $this->postService->setWidgetsData($adminWidgetData['admin']);
            try {
                $postData = $this->postService->setPostData(
                    $formData,
                    $filesData,
                    json_encode(
                        array_merge($frontendWidgetData, $adminWidgetData)
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
        return view('adminlte.post.new', [
            'categories' => $categories,
            'posts' => $posts,
        ]);
    }

    public function update(Request $request, int $postId): Response|ResponseFactory|View|Factory
    {
        $categories = Category::with('childrenRecursive')
            ->whereNull('parent_id')
            ->get();
        $post = $this->postRepository->findById($postId);

        $posts = $this->postRepository->additionalPostsPublishList($postId)->get();

        if ($request->isMethod('POST')) {
            $requestData = $request->request->all();
            $allFilesData = $request->files->all();

            $formData = $requestData['formData'];
            $filesData = $allFilesData['formData'];


            $adminWidgetData = $this->postService->matchingRequestData($requestData, $allFilesData);
            $frontendWidgetData = $this->postService->setWidgetsData($adminWidgetData['admin']);
            try {
                $postData = $this->postService->setPostData(
                    $formData,
                    $filesData,
                    json_encode(
                        array_merge($frontendWidgetData, $adminWidgetData)
                    )
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

        return view('adminlte.post.edit', [
            'categories' => $categories,
            'post' => $post,
            'posts' => $posts,
            'additionalPosts' => $post->additionalPostsToMany()->get(),
            'body' => json_decode($post->body)->admin,
        ]);
    }

    public function delete()
    {

    }
}
