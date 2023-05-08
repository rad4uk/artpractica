<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Services\HomePageService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __construct(
        private readonly HomePageService $homePageService
    )
    {

    }
    public function index(): View|Factory
    {
        $homePage = Page::where('id', 1)->with('categories', 'services')->firstOrFail();

        $additionalCategoriesData = $this->homePageService
            ->setAdditionalCategories($homePage->categories);

        $additionalServicesData = $this->homePageService
            ->setAdditionalServices($homePage->services);

        $slidersData = $this->homePageService->setSlidersData(
            json_decode($homePage->sliders_data),
            $homePage
        );

        return view('frontend/page/homepage', [
            'additionalCategoriesData' => $additionalCategoriesData,
            'additionalServiceData' => $additionalServicesData,
            'firstSectionData' => json_decode($homePage->first_section_data),
            'secondSectionData' => json_decode($homePage->second_section_data),
            'slidersData' => $slidersData,
            'homePage' => $homePage
        ]);
    }
}
