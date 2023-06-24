<?php

namespace App\Providers;

use App\Repositories\Auth\AuthRepository;
use App\Repositories\Auth\AuthRepositoryImplement;
use App\Repositories\Book\BookRepository;
use App\Repositories\Book\BookRepositoryImplement;
use App\Repositories\Bookborrowing\BookborrowingRepository;
use App\Repositories\Bookborrowing\BookborrowingRepositoryImplement;
use App\Repositories\Dashboard\DashboardRepository;
use App\Repositories\Dashboard\DashboardRepositoryImplement;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            AuthRepository::class,
            AuthRepositoryImplement::class,
        );
        $this->app->bind(
            BookRepository::class,
            BookRepositoryImplement::class,
        );
        $this->app->bind(
            BookborrowingRepository::class,
            BookborrowingRepositoryImplement::class,
        );
        $this->app->bind(
            DashboardRepository::class,
            DashboardRepositoryImplement::class,
            
        );
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
