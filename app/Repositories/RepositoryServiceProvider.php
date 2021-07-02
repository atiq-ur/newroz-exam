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
        $this->app->bind(OrderInterface::class, OrderRepository::class);
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
