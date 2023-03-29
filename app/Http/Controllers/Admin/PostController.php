<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostCreateRequest;
use App\Interfaces\PostRepositoryInterface;
use App\Models\Category;
use App\Models\Post;
use App\Repositories\PostRepository;
use App\Services\PostService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct(
        private readonly PostRepositoryInterface $postRepository
    )
    {

    }

    public function index()
    {
        return view('adminlte.post.index', [
            'posts' => $this->postRepository->list()
        ]);
    }

    public function new()
    {
        $categories = Category::with('childrenRecursive')
            ->whereNull('parent_id')
            ->get();

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

        $postService = new PostService(
            $validated['title'],
            $validated['description'],
            ($validated['parent'] == -1) ? null : $validated['parent'],
            $validated['slug'],
            ($request->status === 'on') ? 1 : 0,
            url('/storage/' . $filesPath)
        );

        $this->postRepository->create($postService->getDetails());

        return redirect(route('admin_post_index'), 303);



//        return view('adminlte.post.new', [
//            'categories' => $categories
//        ]);
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
