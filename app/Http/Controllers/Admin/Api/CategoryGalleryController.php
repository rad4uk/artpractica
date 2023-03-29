<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Api\CategoryImageRequest;
use App\Http\Requests\Admin\Api\CategoryImageUpdateRequest;
use App\Models\CategoryImage;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class CategoryGalleryController extends Controller
{

    public function updateImage(CategoryImageUpdateRequest $request)
    {
        $request->validated();

        $newImageId = $request->get('newImageId');
        $categoryId = $request->get('categoryId');
        $categoryImageId = $request->get('categoryImageId');

        $categoryImageData = CategoryImage::where('id', $categoryImageId)->update([
            'category_id' => $categoryId,
            'image_id' => $newImageId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        return response()->json([
            'message' => 'success',
            'textData' => ['Ваши файлы загружены'],
            'data' => (CategoryImage::where('id', $categoryImageId)->with('image')->first())
        ]);
    }

    public function createImage(CategoryImageRequest $request)
    {
        $request->validated();

        $image = $request->files->get('image');
        $categoryId = $request->get('categoryId');
        $categoryImageId = $request->get('categoryImageId');

        $fileName = time() . '_' . $image->getClientOriginalName();

        $filesPath = Storage::disk('public')->putFileAs('/images', $image, $fileName);

        $optimizerChain = OptimizerChainFactory::create();
        $optimizerChain->optimize(storage_path('app/public/' . $filesPath));

        $imageData = Image::create([
            'path' => url('/storage/' . $filesPath),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $categoryImageData = CategoryImage::where('id', $categoryImageId)->update([
            'category_id' => $categoryId,
            'image_id' => $imageData['id'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        return response()->json([
            'message' => 'success',
            'textData' => ['Ваши файлы загружены'],
            'data' => (CategoryImage::where('id', $categoryImageId)->with('image')->first())
        ]);
    }
}
