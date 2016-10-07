<?php

namespace Ignite\Core\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

abstract class CoreRouteServiceProvider extends ServiceProvider {

    /**
     * The root namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $namespace = null;

    /**
     * @var null
     */
    protected $alias = null;

    /**
     * @var null
     */
    protected $prefix = null;

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function boot() {
        parent::boot();
    }

    /**
     * @return string
     */
    abstract protected function getModuleRoutes();

    /**
     * @return string
     */
    abstract protected function getApiRoutes();

    abstract protected function getFrontendRoutes();

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function map(Router $router) {

        $router->group(['prefix' => 'api/', 'as' => 'api.'], function (Router $router) {
            $this->loadApiRoutes($router);
        });
        $this->loadFrontendRoutes($router);
        $this->loadBackendRoutes($router);
    }

    private function loadFrontendRoutes(Router $router) {
        $module_routes = $this->getFrontendRoutes();
        if ($module_routes && file_exists($module_routes)) {
            $router->group([
                'namespace' => $this->namespace,
                'prefix' => 'auth',
                'as' => 'public.'
                    ], function (Router $router) use ($module_routes) {
                require $module_routes;
            });
        }
    }

    /**
     * @param Router $router
     */
    private function loadBackendRoutes(Router $router) {
        $module_routes = $this->getModuleRoutes();
        if ($module_routes && file_exists($module_routes)) {
            $router->group([
                'namespace' => $this->namespace,
                'prefix' => $this->prefix,
                'middleware' => mconfig('core.core.middleware.backend'),
                'as' => $this->alias . ".",
                    ], function (Router $router) use ($module_routes) {
                require $module_routes;
            });
        }
    }

    /**
     * @param Router $router
     */
    private function loadApiRoutes(Router $router) {
        $api = $this->getApiRoutes();
        if ($api && file_exists($api)) {
            $router->group(['namespace' => $this->namespace,
                'prefix' => $this->prefix,
                'middleware' => mconfig('core.core.middleware.api'),
                'as' => $this->alias . '.',
                    ], function (Router $router) use ($api) {
                require $api;
            });
        }
    }

}
