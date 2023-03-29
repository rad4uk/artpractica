<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Api\ImagesRequest;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class ImageController extends Controller
{

    public function index()
    {
        $images = DB::table('images')->orderBy('updated_at','DESC')->get();

        return response()->json($images);
    }

    public function create(ImagesRequest $request)
    {
        $request->validated();

        $images = $request->files->get('images');
        $imagesData = [];
        foreach ($images as $image){

            $fileName = time() . '_' . $image->getClientOriginalName();

            $filesPath = Storage::disk('public')->putFileAs('/images', $image, $fileName);

            ImageOptimizer::optimize(storage_path('app/public/' . $filesPath));

            $imagesData[] = Image::create([
                'alt' => $request->alt ?? '',
                'path' => url('/storage/' . $filesPath),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        }
        return response()->json([
            'message' => 'success',
            'textData' => ['Ваши файлы загружены'],
            'data' => $imagesData
            ],200);

    }
}
