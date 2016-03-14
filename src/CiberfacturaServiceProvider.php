<?php

namespace Raalveco\Ciberfactura;

use Illuminate\Support\ServiceProvider;
use Raalveco\Ciberfactura\Libraries\Cfdi;
use Raalveco\Ciberfactura\Models\CfdiFactura;

class CiberfacturaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/migrations' => base_path('database/migrations'),
            __DIR__.'/config' => base_path('config/packages/raalveco/ciberfactura'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('cfdi', function () {
            return new Cfdi();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'cfdi'
        ];
    }
}
