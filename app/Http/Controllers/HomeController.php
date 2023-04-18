<?php

namespace App\Http\Controllers;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use App\Models\Page;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository
    )
    {

    }
    public function index()
    {
        $categories = $this->categoryRepository->list();

        $homePage = Page::where('id', 1)->with('categories')->firstOrFail();
        $additionalCategoriesData = [];

        foreach ($homePage->categories as $key => $category){
            $additionalCategoriesData[$key]['title'] = $category->title;
            $additionalCategoriesData[$key]['image'] = $category->getFilePath($category->page_image);
            $additionalCategoriesData[$key]['slug'] = route('categories', $category->slug);
        }

        return view('frontend/page/homepage', ['additionalCategoriesData' => $additionalCategoriesData]);
    }
}
