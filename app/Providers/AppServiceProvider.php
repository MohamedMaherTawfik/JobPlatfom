<?php

namespace App\Providers;

use App\Interface\commentInterface;
use App\interface\postInterface;
use App\Repository\commentRepository;
use App\Repository\postRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(postInterface::class, postRepository::class);
        $this->app->bind(commentInterface::class, commentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
