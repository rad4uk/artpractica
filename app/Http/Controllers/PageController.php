<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function portfolio()
    {
        return view('frontend/page/portfolio');
    }
}
