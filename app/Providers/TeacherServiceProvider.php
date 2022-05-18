<?php

namespace App\Providers;

use App\Repository\TeacherInterface;
use App\Repository\TeacherRepository;
use Illuminate\Support\ServiceProvider;

class TeacherServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TeacherInterface::class, function($app) {
            return new TeacherRepository();
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
