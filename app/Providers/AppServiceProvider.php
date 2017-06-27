<?php

namespace App\Providers;

use App\Repositories\OnboardingStatusRepository;
use App\Repository\Contracts\OnboardingStatusRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(OnboardingStatusRepositoryInterface::class, OnboardingStatusRepository::class);
    }
}
