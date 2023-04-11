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

    public function new(Request $request): Response|ResponseFactory|View|Factory
    {
        $categories = Category::with('childrenRecursive')
            ->whereNull('parent_id')
            ->get();

        if ($request->isMethod('POST')) {
            $requestData = $request->request->all();
            $filesData = $request->files->all();
            $adminWidgetData = $this->postService->matchingRequestData(
                $request->request->all(),
                $request->files->all()
            );
            $frontendWidgetData = $this->postService->setWidgetsData($adminWidgetData['admin']);
            try {
                $postData = $this->postService->setPostData(
                    $requestData['formData'],
                    $filesData['formData'],
                    json_encode(
                        array_merge($frontendWidgetData, $adminWidgetData)
                    )
                );
            } catch (\RuntimeException $exception) {
                return response($exception->getMessage(), 422);
            }

            $this->postRepository->create($postData);

            return response('', 201);
        }
        return view('adminlte.post.new', [
            'categories' => $categories,
        ]);
    }

    public function create(PostCreateRequest $request)
    {
        $validated = $request->validated();

        $image = $request->files->get('preview_image');

        $fileName = time() . '_' . $image->getClientOriginalName();

        $filesPath = Storage::disk('public')->putFileAs('/images', $image, $fileName);

//        $postService = new PostService(
//            $validated['title'],
//            $validated['description'],
//            ($validated['parent'] == -1) ? null : $validated['parent'],
//            $validated['slug'],
//            ($request->status === 'on') ? 1 : 0,
//            url('/storage/' . $filesPath)
//        );

//        $this->postRepository->create($this->postService->getDetails());

        return redirect(route('admin_post_index'), 303);


//        return view('adminlte.post.new', [
//            'categories' => $categories
//        ]);
    }

    public function update(int $postId)
    {
        $categories = Category::with('childrenRecursive')
            ->whereNull('parent_id')
            ->get();
        $post = $this->postRepository->findById($postId);
        $post->preview_image = $post->getFullImagePath($post->preview_image);

        return view('adminlte.post.edit', [
            'categories' => $categories,
            'post' => $post,
            'body' => json_decode($post->body)->admin,
        ]);
    }

    public function delete()
    {

    }
}
