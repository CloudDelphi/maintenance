<?php

namespace MBonaldo\Maintenance;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;

class MaintenanceServiceProvider extends ServiceProvider
{
	/**
     * The console commands.
     *
     * @var bool
     */
    protected $commands = [
        'MBonaldo\Maintenance\Commands\MaintenanceOff',
        'MBonaldo\Maintenance\Commands\MaintenanceOn',
    ];
	
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'mbonaldo');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'mbonaldo');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        //if ($this->app->runningInConsole()) {
        //    $this->bootForConsole();
        //}
        $this->publishes([
            __DIR__.'/../config/maintenance.php' => config_path('maintenance.php'),
        ]);		
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/maintenance.php', 'maintenance');

		$this->commands($this->commands);
		
        // Register the service the package provides.
        $this->app->singleton('maintenance', function ($app) {
            return new Maintenance;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['maintenance'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/maintenance.php' => config_path('maintenance.php'),
        ], 'maintenance.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/mbonaldo'),
        ], 'maintenance.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/mbonaldo'),
        ], 'maintenance.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/mbonaldo'),
        ], 'maintenance.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
