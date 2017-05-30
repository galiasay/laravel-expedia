<?php

namespace Galiasay\Expedia;

use Galiasay\Expedia\Commands\ExpediaImport;
use Galiasay\Expedia\Services\ExpediaApi;
use Illuminate\Support\ServiceProvider;

/**
 * Class ExpediaServiceProvider
 * @package Galiasay\Expedia
 */
class ExpediaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/expedia.php' => config_path('expedia.php'),
        ]);

        $this->publishes([
            __DIR__ . '/../database/migrations' => base_path('/database/migrations'),
        ], 'migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/expedia.php', 'expedia');

        $this->registerApi();
        $this->registerCommands();
    }

    /**
     * Register the commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        $this->registerImportCommand();
    }

    /**
     * Register Expedia api.
     *
     * @return void
     */
    public function registerApi()
    {
        $this->app->singleton('ExpediaApi', function ($app) {

            $api = new ExpediaApi();
            $api->setApiKey(config('expedia.api_key'));
            $api->setCid(config('expedia.cid'));
            $api->setSecretKey(config('expedia.secret'));
            $api->setMinorRev(config('expedia.minor_rev'));
            $api->setCurrencyCode(config('expedia.currency_code'));
            $api->setLocale(config('expedia.locale'));
            $api->setCustomerSessionId(session_id());

            return $api;
        });
    }

    /**
     * Register the 'expedia:import' command.
     *
     * @return void
     */
    protected function registerImportCommand()
    {
        $this->app->singleton('command.expedia.import', function ($app) {
            if (!class_exists($logHandler = config('expedia.log_handler'))) {
                throw new \InvalidArgumentException("A {$logHandler} does not exist.");
            }

            $tablePrefix = $app['config']->get('expedia.table_prefix');
            $remoteUrlFiles = $app['config']->get('expedia.remote_url_files');

            return new ExpediaImport($app->make($logHandler), $tablePrefix, $remoteUrlFiles);
        });

        $this->commands('command.expedia.import');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'command.expedia.import'
        ];
    }
}
