<?php

namespace App\Http\Controllers;

use App\Repositories\PageRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct(
        private readonly PageRepository $pageRepository
    )
    {
    }

    public function portfolio()
    {
        return view('frontend/page/portfolio');
    }

    public function about(): View|Factory
    {
        $page = $this->pageRepository->findById(2);
        return view('frontend/page/about', [
            'page' => $page,
            'firstSectionData' => json_decode($page->first_section_data),
            'secondSectionData' => json_decode($page->second_section_data),
            'thirdSectionData' => json_decode($page->third_section_data),
        ]);
    }

    public function contact(): View|Factory
    {
        $page = $this->pageRepository->findById(3);

        return view('frontend.page.contact', [
            'page' => $page,
            'contactData' => json_decode($page->first_section_data)
        ]);
    }
}
