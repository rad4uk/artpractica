<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
    )
    {

    }

    public function index()
    {
//        $data = Category::where('id', 5)->with('children')->get();
//        $childrens = $this->categoryRepository->getChildren($validated['id']);
//        dd($data);
        return view('adminlte.category.index');
    }

    public function new()
    {
        return view('adminlte.category.new', [
            'categories' => $this->categoryRepository->getCategoryTree()
        ]);
    }

    public function create(CategoryRequest $request)
    {
        $validated = $request->validated();
        $categoryCreateService = new CategoryService(
            ($request->request->get('parent') == -1) ? null : $request->request->get('parent'),
            $validated['title'],
            $validated['description'],
            $validated['slug'],
            ($request->status === 'on') ? 1 : 0
        );
        $this->categoryRepository->create($categoryCreateService->getDetails());

        return redirect(route('admin_category_index'), 303);
    }

    public function delete(int $catId)
    {
        $this->categoryRepository->delete($catId);
        return view('adminlte.category.index');
    }

    public function edit(int $id)
    {
        $category = $this->categoryRepository->getParentCategoryAndImages($id);

        return view('adminlte.category.edit', [
            'categories' => $this->categoryRepository->getCategoryTree(),
            'category' => $category,
            'slug' => CategoryService::getFullSlug($category)
        ]);
    }

    public function update(CategoryRequest $request, int $id)
    {
        $validated = $request->validated();

        $categoryUpdateService = new CategoryService(
            ($request->parent == -1) ? null : $request->parent,
            $validated['title'],
            $validated['description'],
            $validated['slug'],
            ($request->status === 'on') ? 1 : 0
        );
        $this->categoryRepository->update($id, $categoryUpdateService->getDetails());

        return redirect(route('admin_category_index'), 303);
    }
}
