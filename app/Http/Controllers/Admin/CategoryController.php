<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use App\Models\Page;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
    )
    {

    }

    public function index()
    {
        return view('adminlte.category.index', [
            'categories' =>  Category::all()
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

        if ($request->files->has('page_image')){
            $file = $request->files->get('page_image');
            Storage::disk('public')->putFileAs(
                config('files-path.categories.publicImagePath'),
                $file,
                $file->getClientOriginalName()
            );
            $details['page_image'] = $file->getClientOriginalName();
        }
        $this->categoryRepository->create($details);

        return response([
            'route' => route('admin_category_index')
        ], 201);
    }

    public function delete(int $catId)
    {
        $this->categoryRepository->delete($catId);
        return view('adminlte.category.index');
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

    public function preview()
    {

    }

    public function update(Request $request, int $id)
    {
        $details = $request->request->all();
        $parentId = $request->request->get('parent_id') == -1 ? null : $request->request->get('parent_id');
        $details['parent_id'] = $parentId;
        $pageId = $request->request->get('page_id') == -1 ? null : $request->request->get('page_id');
        $details['page_id'] = $pageId;

        if ($request->files->has('page_image')){
            $file = $request->files->get('page_image');
            Storage::disk('public')->putFileAs(
                config('files-path.categories.publicImagePath'),
                $file,
                $file->getClientOriginalName()
            );
            $details['page_image'] = $file->getClientOriginalName();
        }
//        dd($details);
        $this->categoryRepository->update($id, $details);

        return response([
            'route' => route('admin_category_index')
        ], 201);
    }
}
