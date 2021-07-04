<?php

namespace App\Repositories;

use Illuminate\Support\ServiceProvider;
class RepositoryServiceProvider extends ServiceProvider{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductInterface::class, ProductRepository::class);
        $this->app->bind(OrderInterface::class, OrderRepository::class);
        $this->app->bind(OfferInterface::class, OfferRepository::class);
        $this->app->bind(PreOrderInterface::class, PreOrderRepository::class);
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
