<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
                
            // Rutas para el módulo médico
            Route::middleware('web')
                ->name('medico.')
                ->prefix('medico')
                ->group(base_path('routes/medico.php'));
                
            // Rutas para el módulo de farmacia
            Route::middleware('web')
                ->name('farmacia.')
                ->prefix('farmacia')
                ->group(base_path('routes/farmacia.php'));
                
            // Rutas para el módulo académico
            Route::middleware('web')
                ->name('academico.')
                ->prefix('academico')
                ->group(base_path('routes/academico.php'));
        });
    }
}