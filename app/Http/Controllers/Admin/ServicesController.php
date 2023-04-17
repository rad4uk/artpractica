<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\ServicesRepository;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function __construct(
        public readonly ServicesRepository $servicesRepository
    )
    {
    }

    public function index()
    {
        return view('adminlte.services.index', [
            'posts' => $this->servicesRepository->list()
        ]);
    }

    public function create(Request $request)
    {
        $categories = Category::with('childrenRecursive')
            ->whereNull('parent_id')
            ->get();

        return view('adminlte.services.new', [
            'categories' => $categories,
//            'posts' => $posts,
        ]);
    }

    public function update()
    {

    }

    public function preview(int $postId)
    {

    }
}
