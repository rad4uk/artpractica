<?php

use App\Http\Controllers\Admin\Api\CategoryController;
use App\Http\Controllers\Admin\Api\CategoryGalleryController;
use App\Http\Controllers\Admin\Api\ImageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('images')->group(function (){
    Route::get('/', [ImageController::class, 'index']);
    Route::post('/create', [ImageController::class, 'create']);
    Route::any('/{id}/edit', [ImageController::class, 'update']);
});


Route::prefix('category')->group(function (){

    Route::post('/image/create', [CategoryGalleryController::class, 'createImage']);
    Route::post('/image/update', [CategoryGalleryController::class, 'updateImage']);

    Route::get('/image', [CategoryController::class, 'getCategoryImages']);
    Route::get('/fetch', [CategoryController::class, 'fetchCategories']);
    Route::post('/delete', [CategoryController::class, 'delete']);
});


Route::get('portfolio/next/posts/{offset}', [PortfolioController::class, 'getNextPosts']);


Route::prefix('project')->group(function (){
    Route::post('/new', [PostController::class, 'new']);
});
