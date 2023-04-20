<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Page\UpdateRequest;
use App\Models\Page;
use App\Repositories\PageRepository;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct(
        private readonly PageRepository $pageRepository
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
        if ($request->isMethod('POST')){
            $details = $request->request->all();
            $this->pageRepository->create($details);
            return redirect(route('admin_page_index'), 303);
        }
        return view('adminlte/pages/new');
    }

    public function new()
    {

        return view('adminlte.pages.new');
    }

    public function update(UpdateRequest $request, int $pageId)
    {
        $page = $this->pageRepository->findById($pageId);

        if($request->isMethod('POST')){
            $details = $request->request->all();
            $this->pageRepository->update($pageId, $details);
            return redirect(route('admin_page_index'), 303);
        }
        return view('adminlte.pages.edit', ['page' => $page]);
    }

    public function delete(Request $request)
    {
        dd($request);
        if($request->isMethod('POST')){

        }
    }
}
