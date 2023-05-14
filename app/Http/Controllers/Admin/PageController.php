<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageCreateRequest;
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

    public function create(PageCreateRequest $request)
    {
        $this->pageRepository->create(
            $request->validated()
        );
        return response('', 201);
    }

    public function new()
    {
        return view('adminlte.pages.new');
    }


    public function delete(Request $request)
    {
        if($request->isMethod('POST')){

        }
    }
}
