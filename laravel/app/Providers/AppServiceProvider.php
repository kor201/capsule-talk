<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Message\MessageInterface;
use App\Repositories\Message\MessageRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MessageInterface::class, MessageRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
