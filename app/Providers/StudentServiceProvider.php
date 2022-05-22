<?php

namespace App\Providers;

use App\Repository\Student\StudentInterface;
use App\Repository\Student\StudentRepository;
use Illuminate\Support\ServiceProvider;

class StudentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(StudentInterface::class, function($app) {
            return new StudentRepository();
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
