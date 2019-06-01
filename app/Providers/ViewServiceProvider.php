<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        View::composer(
            'index', 'App\Http\View\Auth\LoginUser'
        );

        View::composer('goods', function ($view) {
            //
            $view->with('authuserinfo', '111111111111');
        });
    }
}
