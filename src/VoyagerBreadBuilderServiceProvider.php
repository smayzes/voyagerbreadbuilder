<?php

namespace Codelabs\VoyagerBreadBuilder;

use Codelabs\VoyagerBreadBuilder\Console\Commands\DataRowBreadCommand;
use Codelabs\VoyagerBreadBuilder\Console\Commands\DataTypeBreadCommand;
use Codelabs\VoyagerBreadBuilder\Console\Commands\PermissionBreadCommand;
use Illuminate\Support\ServiceProvider;

class VoyagerBreadBuilderServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            // Publishing the configuration file.
            $this->publishes([
                __DIR__.'/../config/voyagerbreadbuilder.php' => config_path('voyagerbreadbuilder.php'),
            ], 'voyagerbreadbuilder.config');

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
