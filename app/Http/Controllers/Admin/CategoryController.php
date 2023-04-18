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
//        $data = Category::where('id', 5)->with('children')->get();
//        $childrens = $this->categoryRepository->getChildren($validated['id']);
//        dd($data);

        return view('adminlte.category.index', [
            'categories' =>  Category::all()
        ]);
    }

    public function new(Request $request)
    {
//        if ($request->isMethod('POST')){
//
//            dd($request->request->all());
//        }
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
        $details['status'] = $request->request->get('status') === 'on' ? 1 : 0;

        if ($request->files->has('page_image')){
            $file = $request->files->get('page_image');
            Storage::disk('public')->putFileAs(
                '/images/categories',
                $file,
                $file->getClientOriginalName()
            );
            $details['page_image'] = $file->getClientOriginalName();
        }
        $this->categoryRepository->create($details);

        return redirect(route('admin_category_index'), 303);
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
        $details['status'] = $request->request->get('status') === 'on' ? 1 : 0;
        unset($details['_token']);
        if ($request->files->has('page_image')){
            $file = $request->files->get('page_image');
            Storage::disk('public')->putFileAs(
                '/images/categories',
                $file,
                $file->getClientOriginalName()
            );
            $details['page_image'] = $file->getClientOriginalName();
        }

        $this->categoryRepository->update($id, $details);

        return redirect(route('admin_category_index'), 303);
    }
}
