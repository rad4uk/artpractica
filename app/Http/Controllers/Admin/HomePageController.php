<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\PageRepository;
use App\Services\Admin\HomePageService;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function __construct(
        private readonly PageRepository $pageRepository,
        private readonly HomePageService $homePageService
    )
    {
    }

    public function create(Request $request)
    {
        $slidersData = $this->homePageService->setSliderData(
            $request->request->all(),
            $request->files->all()
        );
        if ($request->isMethod('POST')){
            $details = $request->request->all();
            $details['sliders_data'] = json_encode($slidersData);
            $this->pageRepository->create($details);
            return response('', 201);
        }
        return view('adminlte.pages.home.new');
    }

    public function update(Request $request)
    {
        $page = $this->pageRepository->findById(1);
        if($request->isMethod('POST')){
            $slidersData = $this->homePageService->setSliderData(
                $request->request->all(),
                $request->files->all()
            );
            $details = $request->request->all();
            $details['sliders_data'] = json_encode($slidersData);
            unset($details['firstSliderData']);
            unset($details['secondSliderData']);
            unset($details['thirdSliderData']);
            $this->pageRepository->update(1, $details);
            return response('', 201);
        }
        return view('adminlte.pages.home.edit', [
            'page' => $page
        ]);
    }
}
