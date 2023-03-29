<?php

namespace App\Providers;

use App\Repository\Interface\TaskRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repository\Interface\UserRepositoryInterface;
use App\Repository\TaskRepository;
use App\Repository\UserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
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
