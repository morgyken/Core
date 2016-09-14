<?php

namespace Ignite\Core\Providers;

use Ignite\Core\Entities\DashboardWidgets;
use Ignite\Core\Repositories\CacheWidgetDecorator;
use Ignite\Core\Repositories\EloquentWidgetRepository;
use Ignite\Core\Repositories\WidgetRepository;
use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->app->bind(
                WidgetRepository::class, function () {
            $repository = new EloquentWidgetRepository(new DashboardWidgets());
            if (!config('app.cache')) {
                return $repository;
            }
            return new CacheWidgetDecorator($repository);
        }
        );
    }

    public function boot(/* StylistThemeManager $theme */) {
        /* $this->publishes([
          __DIR__ . '/../Resources/views' => base_path('resources/views/asgard/dashboard'),
          ], 'views');

          $this->app['view']->prependNamespace(
          'dashboard', base_path('resources/views/ignite/dashboard')
          ); */
        $this->registerViews();
        /*  $this->app['view']->prependNamespace(
          'dashboard', $theme->find(mconfig('core.core.admin-theme'))->getPath() . '/views/modules/dashboard'
          ); */
    }

    private function registerViews() {
        $viewPath = base_path('resources/views/modules/core');

        $sourcePath = __DIR__ . '/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
                            return $path . '/modules/core';
                        }, \Config::get('view.paths')), [$sourcePath]), 'dashboard');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return [];
    }

}
