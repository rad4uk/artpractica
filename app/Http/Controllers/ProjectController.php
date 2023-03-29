<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view('frontend/page/project');
    }
    public function index2()
    {
        return view('frontend/page/project2');
    }
    public function index3()
    {
        return view('frontend/page/project3');
    }
    public function index4()
    {
        return view('frontend/page/project4');
    }
}
