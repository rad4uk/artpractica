<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Api\CategoryDeleteRequest;
use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use App\Models\CategoryImage;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository
    )
    {
    }

    public function fetchCategories()
    {
        return response()->json($this->categoryRepository->list());
    }

    public function delete(CategoryDeleteRequest $request)
    {
        $validated = $request->validated();

        $category = $this->categoryRepository->getChildren($validated['id']);

        if (count($category->children) > 0){
            return response()->json([
                'statusText' => 'hasChildren',
                'message' => 'Вы не можете удалить эту категорию, так как ей принадлежат другие категории или проекты, сперва удалите дочерние категории или проекты или присвойте им другого родителя.',
                'isDelete' => 0
            ]);
        }

        return response()->json([
            'statusText' => 'success',
            'message' => 'Категория успешно удалена',
            'isDelete' => $this->categoryRepository->delete($validated['id'])
        ]);
    }

    public function getCategoryImages(Request $request)
    {
        return response()->json($this->categoryRepository->getCategoryImages($request->id));
//        return response()->json($request->id);
    }
}
