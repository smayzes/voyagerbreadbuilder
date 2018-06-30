<?php

namespace Codelabs\VoyagerBreadBuilder;

use Illuminate\Support\ServiceProvider;
use Codelabs\VoyagerBreadBuilder\Console\Commands\DataRowBreadCommand;
use Codelabs\VoyagerBreadBuilder\Console\Commands\DataTypeBreadCommand;
use Codelabs\VoyagerBreadBuilder\Console\Commands\PermissionBreadCommand;

class VoyagerBreadBuilderServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'codelabs');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'codelabs');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {

            // Publishing the configuration file.
            $this->publishes([
                __DIR__.'/../config/voyagerbreadbuilder.php' => config_path('voyagerbreadbuilder.php'),
            ], 'voyagerbreadbuilder.config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => base_path('resources/views/vendor/codelabs'),
            ], 'voyagerbreadbuilder.views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/codelabs'),
            ], 'voyagerbreadbuilder.views');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/codelabs'),
            ], 'voyagerbreadbuilder.views');*/

            // Registering package commands.
            $this->commands([
                 DataTypeBreadCommand::class,
                 DataRowBreadCommand::class,
                 PermissionBreadCommand::class,
             ]);
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/voyagerbreadbuilder.php', 'voyagerbreadbuilder');

        // Register the service the package provides.
        $this->app->singleton('voyagerbreadbuilder', function ($app) {
            return new VoyagerBreadBuilder;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['voyagerbreadbuilder'];
    }
}
