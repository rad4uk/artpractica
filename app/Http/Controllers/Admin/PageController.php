<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Page\UpdateRequest;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
//        $pages = Page::with('images')->orderBy('updated_at','DESC')->get();

        return view('adminlte.pages.index', [
            'pages' => Page::with('images')->orderBy('updated_at','DESC')->get()
        ]);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('POST')){
            $page = Page::create([
               'title' => $request->title,
               'description' => $request->description,
               'url' => $request->pageUrl,
               'created_at' => now(),
               'updated_at' => now()
            ]);

            return redirect(route('admin_page_index'), 303);
        }
        return view('adminlte/pages/new');
    }

    public function update(UpdateRequest $request)
    {
        $page = Page::where('id', $request->id)->first();

        if($request->isMethod('POST')){
            $result = Page::where('id', $page->id)->update([
               'title' => $request->title,
               'description' => $request->description,
               'url' => $request->pageUrl,
               'updated_at' => now()
            ]);
            return redirect(route('admin_page_index'), 303);
        }
        return view('adminlte.pages.edit',['page' => $page]);
    }

    public function delete(Request $request)
    {
        dd($request);
        if($request->isMethod('POST')){

        }
    }
}
