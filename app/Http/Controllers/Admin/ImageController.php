<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Page;
use App\Models\PageImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class ImageController extends Controller
{
    public function index()
    {
//        Cache::put('test','qwerty', Carbon::now()->addMinute());
//
//        dd(Cache::get('test'));

        return view('adminlte.gallery.index');
    }

    public function create(Request $request)
    {

        if($request->hasFile('images')){
            $images = $request->files->get('images');

            foreach ($images as $image){

                $fileName = time() . '_' . $image->getClientOriginalName();

                $filesPath = Storage::disk('public')->putFileAs('/images', $image, $fileName);

                Image::create([
                    'page_id' => null,
                    'alt' => $request->alt ?? '',
                    'path' => url('/storage/' . $filesPath),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                return redirect(route('admin_gallery_index'), 303);
            }
        }
        return redirect(route('admin_gallery_index'), 303);
    }

    public function update()
    {
        return view('adminlte.gallery.edit');
    }
}
