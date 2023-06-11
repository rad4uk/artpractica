<?php

use App\Http\Controllers\Admin\AboutPageController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactPageController;
use App\Http\Controllers\Admin\HomePageController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\PageController as FrontendPageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\Admin\ServicesController as AdminServicesController;
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
        Route::get('/new', [PageController::class, 'new'])->name('admin_page_new');
        Route::post('/create', [PageController::class, 'create'])->name('admin_page_create');
//        Route::any('/{id}/edit', [PageController::class, 'update'])->name('admin_page_edit');
        Route::post('/{id}/delete', [PageController::class, 'update'])->name('admin_page_delete');

        Route::any('/1/edit', [HomePageController::class, 'update'])->name('admin_home_page_edit');

        Route::get('/2/edit', [AboutPageController::class, 'edit'])->name('admin_about_page_edit');
        Route::post('/2/edit', [AboutPageController::class, 'update'])->name('admin_about_page_update');

        Route::get('/3/edit', [ContactPageController::class, 'edit'])->name('admin_contact_page_edit');
        Route::post('/3/edit', [ContactPageController::class, 'update'])->name('admin_contact_page_update');
    });

    Route::prefix('post')->group(function (){
        Route::get('/', [PostController::class, 'index'])->name('admin_post_index');
        Route::get('/{id}/preview', [PostController::class, 'preview'])->name('admin_post_preview');
        Route::any('/create', [PostController::class, 'create'])->name('admin_post_create');
        Route::any('/{id}/edit', [PostController::class, 'update'])->name('admin_post_edit');
        Route::delete('/{id}/delete', [PostController::class, 'delete'])->name('admin_post_delete');
    });

    Route::prefix('services')->group(function (){
        Route::get('/', [AdminServicesController::class, 'index'])->name('admin_services_index');
        Route::any('/create', [AdminServicesController::class, 'create'])->name('admin_services_create');
        Route::any('/{id}/edit', [AdminServicesController::class, 'update'])->name('admin_services_edit');
        Route::delete('/{id}/delete', [AdminServicesController::class, 'delete'])->name('admin_services_delete');
    });

    Route::prefix('images')->group(function (){
        Route::get('/', [ImageController::class, 'index'])->name('admin_gallery_index');
        Route::any('/new', [ImageController::class, 'create'])->name('admin_gallery_new');
        Route::any('/{id}/edit', [ImageController::class, 'update'])->name('admin_gallery_edit');
    });

    Route::prefix('categories')->group(function (){
        Route::get('/', [CategoryController::class, 'index'])->name('admin_category_index');
        Route::get('/{id}/preview', [CategoryController::class, 'preview'])->name('admin_category_preview');

        Route::get('/new', [CategoryController::class, 'new'])->name('admin_category_new');
        Route::post('/create', [CategoryController::class, 'create'])->name('admin_category_create');
        Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('admin_category_edit');
        Route::post('/{id}/update', [CategoryController::class, 'update'])->name('admin_category_update');
        Route::delete('/{id}/delete', [CategoryController::class, 'delete'])->name('admin_category_delete');
    });

});
//Route::get('/storage/images/{dir}/{size}/{method}/{file}', [ThumbnailController::class, 'index'])
//    ->where('method', 'resize|crop|fit')
//    ->where('size', '\d+x\d+')
//    ->where('file', '.+\.(png|jpg|gif|jpeg)')
//    ->name('thumbnail');

Route::get('/storage/images/{dir}/{size}/{method}/{file}', ThumbnailController::class)
    ->where('method', 'resize|crop|fit')
    ->where('size', '\d+x\d+')
    ->where('file', '.+\.(png|jpg|webp|jpeg)')
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
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');
Route::get('/portfolio/{categorySlug}/', [PortfolioController::class, 'categories'])->name('categories');
Route::get('/portfolio/project/{slug}/', [ProjectController::class, 'index'])->name('projects');

Route::get('/about/', [FrontendPageController::class, 'about'])->name('about');
Route::get('/contact-us/', [FrontendPageController::class, 'contact'])->name('contact');

Route::post('/consultation/send', ConsultationController::class);

Route::get('/services/', ServicesController::class)->name('services');
Route::get('/services/{slug}', [ServicesController::class, 'show'])->name('service');
