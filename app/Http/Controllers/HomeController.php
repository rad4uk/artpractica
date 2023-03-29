<?php

namespace App\Http\Controllers;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
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
        $categories = $this->categoryRepository->list();

        return view('frontend/page/homepage',['categories' => $categories]);
    }
}
