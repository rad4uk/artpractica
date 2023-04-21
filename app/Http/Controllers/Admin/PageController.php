<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Page\UpdateRequest;
use App\Models\Page;
use App\Repositories\PageRepository;
use App\Services\Admin\HomePageService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct(
        private readonly PageRepository $pageRepository,
        private readonly HomePageService $homePageService
    )
    {
    }

    public function index()
    {
        return view('adminlte.pages.index', [
            'pages' => Page::all()
        ]);
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
        return view('adminlte/pages/new');
    }

    public function new()
    {

        return view('adminlte.pages.new');
    }

    public function update(Request $request, int $pageId)
    {
        $page = $this->pageRepository->findById($pageId);
//        dd($page);
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
            $this->pageRepository->update($pageId, $details);
            return response('', 201);
        }
        return view('adminlte.pages.edit', [
            'page' => $page
        ]);
    }

    public function delete(Request $request)
    {
        dd($request);
        if($request->isMethod('POST')){

        }
    }
}
