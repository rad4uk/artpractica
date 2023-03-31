<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ThumbnailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function (){

    Route::get('/', [AdminController::class, 'index'])->name('admin_home_index');

    Route::prefix('pages')->group(function (){
        Route::get('/', [PageController::class, 'index'])->name('admin_page_index');
        Route::any('/new', [PageController::class, 'create'])->name('admin_page_new');
        Route::any('/{id}/edit', [PageController::class, 'update'])->name('admin_page_edit');
        Route::post('/{id}/delete', [PageController::class, 'update'])->name('admin_page_delete');
    });

    Route::prefix('post')->group(function (){
        Route::get('/', [PostController::class, 'index'])->name('admin_post_index');
        Route::get('/new', [PostController::class, 'new'])->name('admin_post_new');
        Route::post('/new', [PostController::class, 'create'])->name('admin_post_create');
        Route::any('/{id}/edit', [PostController::class, 'update'])->name('admin_post_edit');
        Route::post('/{id}/delete', [PostController::class, 'delete'])->name('admin_post_delete');
    });

    Route::prefix('images')->group(function (){
        Route::get('/', [ImageController::class, 'index'])->name('admin_gallery_index');
        Route::any('/new', [ImageController::class, 'create'])->name('admin_gallery_new');
        Route::any('/{id}/edit', [ImageController::class, 'update'])->name('admin_gallery_edit');
    });

    Route::prefix('categories')->group(function (){
        Route::get('/', [CategoryController::class, 'index'])->name('admin_category_index');
        Route::get('/new', [CategoryController::class, 'new'])->name('admin_category_new');
        Route::post('/new', [CategoryController::class, 'create'])->name('admin_category_create');
        Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('admin_category_edit');
        Route::post('/{id}/edit', [CategoryController::class, 'update'])->name('admin_category_update');
    });

});
Route::get('/storage/images/{dir}/{size}/{method}/{file}', [ThumbnailController::class, 'index'])
    ->where('method', 'resize|crop|fit')
    ->where('size', '\d+x\d+')
    ->where('file', '.+\.(png|jpg|gif|jpeg)')
    ->name('thumbnail');

//Route::middleware([
//    'auth:sanctum',
//    config('jetstream.auth_session'),
//    'verified'
//])->group(function () {
////    Route::get('/admin', function () {
////        return view('dashboard');
////    })->name('dashboard');
//});
Route::get('/portfolio/', [PortfolioController::class, 'index'])->name('portfolio');
Route::get('/portfolio/project-715/', [ProjectController::class, 'index'])->name('project1');
Route::get('/portfolio/project-716/', [ProjectController::class, 'index2'])->name('project2');
Route::get('/portfolio/project-562/', [ProjectController::class, 'index3'])->name('project3');
Route::get('/portfolio/project-788/', [ProjectController::class, 'index4'])->name('project4');
Route::get('/services/', [ServicesController::class, 'index'])->name('services');
Route::get('/about/', [AboutController::class, 'index'])->name('about');
Route::get('/contact-us/', ContactController::class)->name('contact');
