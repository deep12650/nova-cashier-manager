<?php

namespace Themsaid\CashierTool;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class CashierToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'nova-cashier-tool');

        $this->bootRoutes();
        $this->publishConfig();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/nova-cashier-manager.php', 'nova-cashier-manager'
        );
    }

    /**
     * Boot the package routes.
     *
     * @return void
     */
    protected function bootRoutes()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                // Your commands here, if any
            ]);
        }

        $this->app->booted(function () {
            $this->routes();
        });
    }

    /**
     * Define the package routes.
     *
     * @return void
     */
    protected function routes()
    {

        Route::middleware(['nova'])
            ->prefix('nova-cashier-tool-api')
            ->group(__DIR__.'/routes.php');
    }

    /**
     * Publish the configuration file.
     *
     * @return void
     */
    protected function publishConfig()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/nova-cashier-manager.php' => config_path('nova-cashier-manager.php'),
            ], 'nova-cashier-manager-config');
        }
    }
}
