<?php

namespace bachphuc\LaravelTheme\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;

class PackageServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'bachphuc\LaravelTheme\Http\Controllers';

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $packagePath = dirname(__DIR__);

        $this->publishes([
            $packagePath .'/config/theme.php' => config_path('theme.php'),
        ], 'theme-config');

        // register view
        // $this->loadViewsFrom($packagePath . '/resources/views', 'laravel_theme');

        // $this->loadMigrationsFrom($packagePath.'/database/migrations');

        // boot translator
        // $this->loadTranslationsFrom($packagePath . '/resources/lang' , 'laravel_theme');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /*
         * Register the service provider for the dependency.
         */

        $this->mapRoutes();

        $this->app->bind('laravel_theme', function(){
            return new \bachphuc\LaravelTheme\Theme();
        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function mapRoutes()
    {
        // $this->mapApiRoutes();
        // $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        $packagePath = dirname(__DIR__);
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group($packagePath. '/routes/web.php');
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        $packagePath = dirname(__DIR__);
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group($packagePath . '/routes/api.php');
    }
}