<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Establecer el idioma español
        App::setLocale('es');
        
        // Establecer la zona horaria de Venezuela
        date_default_timezone_set('America/Caracas');
        Carbon::setLocale('es');
    }
}
