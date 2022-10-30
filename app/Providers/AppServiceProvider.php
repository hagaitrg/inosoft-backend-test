<?php

namespace App\Providers;

use App\Repository\KendaraanRepository;
use App\Repository\MotorRepository;
use App\Repository\ResponseRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ResponseRepository::class);
        $this->app->bind(KendaraanRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
