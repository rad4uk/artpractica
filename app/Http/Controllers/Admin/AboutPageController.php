<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AboutPageUpdateRequest;
use App\Repositories\PageRepository;
use App\Services\Admin\AboutPageService;
use App\ValueObjects\Page\About\AuthorDescription;
use App\ValueObjects\Page\About\AuthorName;
use App\ValueObjects\Page\About\Description;
use App\ValueObjects\Page\About\FirstSectionData;
use App\ValueObjects\Page\About\Image;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class AboutPageController extends Controller
{
    public function __construct(
        private readonly PageRepository $pageRepository,
        private readonly AboutPageService $aboutPageService
    )
    {
    }

    public function edit(): View|Factory
    {
        $aboutPageData = $this->pageRepository->findById(2);
        return view('adminlte.pages.edit', [
            'page' => $aboutPageData
        ]);
    }

    public function update(AboutPageUpdateRequest $request): Redirector|RedirectResponse
    {
        $validated = $request->validated();

        $firstSectionDataInstance = $this->aboutPageService->setFirstSectionData($validated['first_section_data']);
        $secondSectionDataInstance = $this->aboutPageService->setSecondSectionData($validated['second_section_data']);
        $thirdSectionDataInstance = $this->aboutPageService->setThirdSectionData($validated['third_section_data']);

        $validated['first_section_data'] = json_encode($firstSectionDataInstance);
        $validated['second_section_data'] = json_encode($secondSectionDataInstance);
        $validated['third_section_data'] = json_encode($thirdSectionDataInstance);

        $this->pageRepository->update(2, $validated);

        return redirect('', 201);
    }
}
