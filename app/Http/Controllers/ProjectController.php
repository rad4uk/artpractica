<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function index(string $slug)
    {
        $project = Post::where('slug', $slug)->firstOrFail();

        return view('frontend/project/project', [
            'post' => $project,
            'body' => json_decode($project->body)->frontend
        ]);
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
