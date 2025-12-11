<?php

namespace App\Providers;

use App\Domains\Order\Contracts\OrderServiceInterface;
use App\Domains\Order\Services\OrderService;
use App\Domains\Product\Contracts\ProductServiceInterface;
use App\Domains\Product\Services\ProductService;
use Dedoc\Scramble\Scramble;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(OrderServiceInterface::class, OrderService::class);
        $this->app->singleton(ProductServiceInterface::class, ProductService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Scramble::configure()
            ->expose(
                document: '/docs/api/openapi.json',
            );
    }
}
