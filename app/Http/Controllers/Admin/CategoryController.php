<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use App\Models\Page;
use App\Services\CategoryService;
use App\Services\FileService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly FileService                 $fileService
    )
    {

    }

    public function index()
    {
        return view('adminlte.category.index', [
            'categories' => Category::all()
        ]);
    }

    public function new(Request $request)
    {
        return view('adminlte.category.new', [
            'categories' => $this->categoryRepository->getCategoryTree(),
            'pages' => Page::all(),
        ]);
    }

    public function create(CategoryRequest $request)
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

    public function edit(int $id)
    {
        $category = Category::where('id', $id)->firstOrFail();

        return view('adminlte.category.edit', [
            'categories' => $this->categoryRepository->getCategoryTree(),
            'category' => $category,
            'pages' => Page::all(),
            'slug' => CategoryService::getFullSlug($category)
        ]);
    }


    public function update(Request $request, int $id)
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
