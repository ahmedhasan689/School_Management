<?php

namespace App\Providers;

use App\Repository\Promotion\PromotionInterface;
use App\Repository\Promotion\PromotionRepository;
use Illuminate\Support\ServiceProvider;

class PromotionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PromotionInterface::class, function($app) {
           return new PromotionRepository();
        });
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
