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
        $homePage = Page::where('id', 1)->with('categories', 'services')->firstOrFail();
        $additionalCategoriesData = [];
        $additionalServicesData = [];

        foreach ($homePage->categories as $key => $category){
            $additionalCategoriesData[$key]['title'] = $category->title;
            $additionalCategoriesData[$key]['image'] = $category->getFilePath($category->page_image);
            $additionalCategoriesData[$key]['slug'] = route('categories', $category->slug);
        }

        foreach ($homePage->services as $key => $service){
            $additionalServicesData[$key]['title'] = $service->title;
            $additionalServicesData[$key]['description'] = $service->page_description;
            $additionalServicesData[$key]['image'] = $service->getFilePath($service->page_image);
            $additionalServicesData[$key]['slug'] = route('service', $service->slug);
        }

        return view('frontend/page/homepage', [
            'additionalCategoriesData' => $additionalCategoriesData,
            'additionalServiceData' => $additionalServicesData,
        ]);
    }
}
