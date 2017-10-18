<?php
namespace Neometeor\Library;

use Illuminate\Support\ServiceProvider;

/**
 * Class NeoLibraryServiceProvider
 * @package Neometeor\Library
 */
class NeoLibraryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (is_dir(__DIR__ . '/resources/views/neometeor/library')) {
            $this->loadViewsFrom(__DIR__ . '/resources/views/neometeor/library', 'neolibrary');
        } else {
            $this->loadViewsFrom(__DIR__ . '/views', 'neolibrary');
        }
        $this->publishes([
            __DIR__.'/views' => resource_path('/views/neometeor/library'),
        ]);
        $this->publishes([
            __DIR__.'/assets' => public_path('neometeor/library'),
        ], 'public');
        $this->publishes([
            __DIR__.'/config/neolibrary.php' => config_path('neolibrary.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__ . '/routes.php';
        $this->app->make('Neometeor\Library\NeoLibrary');
    }
}
