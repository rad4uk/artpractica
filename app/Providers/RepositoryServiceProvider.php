<?php

namespace App\Providers;

use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\PageRepositoryInterface;
use App\Interfaces\PostRepositoryInterface;
use App\Interfaces\ServiceRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\PageRepository;
use App\Repositories\PostRepository;
use App\Repositories\ServicesRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(PageRepositoryInterface::class, PageRepository::class);
        $this->app->bind(ServiceRepositoryInterface::class, ServicesRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
