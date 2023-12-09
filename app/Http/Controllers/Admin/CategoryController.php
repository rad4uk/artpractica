<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\PageRepositoryInterface;
use App\Interfaces\PostRepositoryInterface;
use App\Services\CategoryService;
use App\Services\FileService;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class CategoryController extends Controller
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly PageRepositoryInterface     $pageRepository,
        private readonly PostRepositoryInterface     $postRepository,
        private readonly FileService                 $fileService
    )
    {

    }

    public function index(): View|Factory
    {
        return view('adminlte.category.index', [
            'categories' => $this->categoryRepository->list()
        ]);
    }

    public function new(): View|Factory
    {
        return view('adminlte.category.new', [
            'categories' => $this->categoryRepository->getCategoryTree(),
            'pages' => $this->pageRepository->list(),
        ]);
    }

    public function create(CategoryRequest $request): Response|ResponseFactory
    {
        $details = $request->request->all();
        $parentId = $request->request->get('parent_id') == -1 ? null : $request->request->get('parent_id');
        $details['parent_id'] = $parentId;
        $pageId = $request->request->get('page_id') == -1 ? null : $request->request->get('page_id');
        $details['page_id'] = $pageId;

        if ($request->files->has('page_image')) {
            $file = $request->files->get('page_image');

            $details['page_image'] = $this->fileService->saveFile(
                $file,
                config('files-path.categories.publicImagePath')
            );
        }
        $this->categoryRepository->create($details);

        return response([
            'route' => route('admin_category_index')
        ], 201);
    }

    public function edit(int $id): View|Factory
    {
        $category = $this->categoryRepository->findById($id);
        $pages = $this->pageRepository->list();
        $posts = $this->postRepository->findBy(['category_id' => $id], ['category_sort' => 'ASC']);

        return view('adminlte.category.edit', [
            'categories' => $this->categoryRepository->getCategoryTree(),
            'category' => $category,
            'pages' => $pages,
            'slug' => CategoryService::getFullSlug($category),
            'posts' => $posts
        ]);
    }


    public function update(Request $request, int $id): Response|ResponseFactory
    {
        $details = $request->request->all();
        $parentId = $request->request->get('parent_id') == -1 ? null : $request->request->get('parent_id');
        $details['parent_id'] = $parentId;
        $pageId = $request->request->get('page_id') == -1 ? null : $request->request->get('page_id');
        $details['page_id'] = $pageId;

        if ($request->files->has('page_image')) {
            $file = $request->files->get('page_image');
            $details['page_image'] = $this->fileService->saveFile(
                $file,
                config('files-path.categories.publicImagePath')
            );
        }

        $this->categoryRepository->update($id, $details);

        return response([
            'route' => route('admin_category_index')
        ], 201);
    }

    public function delete(int $catId): Redirector|RedirectResponse
    {
        $this->categoryRepository->delete($catId);

        return redirect()->back();
    }
}
