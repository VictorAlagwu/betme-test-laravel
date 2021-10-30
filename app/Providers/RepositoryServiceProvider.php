<?php

namespace App\Providers;

use App\Repositories\Sport\ISportRepository;
use App\Repositories\Sport\SportRepository;
use App\Repositories\SportProvider\ISportProviderRepository;
use App\Repositories\SportProvider\SportProviderRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::singleton(ISportRepository::class, SportRepository::class);
        App::singleton(ISportProviderRepository::class, SportProviderRepository::class);
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
