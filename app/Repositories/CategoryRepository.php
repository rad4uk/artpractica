<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use App\Models\CategoryImage;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function __construct(
        private readonly Category $categoryModel
    )
    {
    }

    public function firstOrFail(int $categoryId)
    {
        return Category::where(['id' => $categoryId])->with('posts')->firstOrFail();
    }

    public function list()
    {
        return Category::orderBy('updated_at', 'DESC')->with('parent', 'categoryImages')->get();
    }

    public function findById(int $catId)
    {
        return Category::query()->findOrFail($catId);
    }

    public function create(array $details)
    {
        return Category::create($details);
    }

    public function update(int $catId, array $details)
    {
        return Category::query()->where('id', $catId)->update($details);
    }

    public function delete(int $cattId)
    {
        return Category::query()->where('id', $cattId)->delete();
    }

    public function parent()
    {
        return Category::belongsTo(Category::class, 'parent_id');
    }


    public function getChildren(int $catId)
    {
        return Category::where('id', $catId)->with('children')->first();
    }

    public function categoryImages()
    {
        return $this->categoryModel->hasMany(CategoryImage::class,'category_id','id')->with('image');
    }

    public function getCategoryTree(){
        return Category::with('childrenRecursive')
            ->whereNull('parent_id')
            ->get();
    }

    public function getParentCategoryAndImages(int $catId)
    {
        return Category::where('id', $catId)->with('parentRecursive', 'categoryImages')->first();
    }

    public function getCategoryImages(int $catId)
    {
        return CategoryImage::where('category_id', $catId)->with('image')->get();
    }
}
