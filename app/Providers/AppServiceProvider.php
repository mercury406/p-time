<?php

namespace App\Providers;

use App\View\Components\Admin\Cities\CityTable;
use App\View\Components\Admin\Regions\RegionTable;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Blade::component('admin-city-table', CityTable::class);
        Blade::component('admin-regions-table', RegionTable::class);
    }
}
