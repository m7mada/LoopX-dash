<?php

namespace App\Providers;

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
        if(!\App::isLocal()){
            \URL::forceScheme('https');
        }

        if (Str::contains(Config::get('app.url'), 'https://')) {
            URL::forceScheme('https');
        }
        
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
