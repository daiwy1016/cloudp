<?php

namespace Cyberziko\Gdrive;

use Illuminate\Support\ServiceProvider;

class GdriveServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot() {
        $this->package('cyberziko/gdrive');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->app['gdrive'] = $this->app->share(function($app) {
            return new GoogleController;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return array('gdrive');
    }

}
