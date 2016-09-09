<?php

/*
 * =============================================================================
 *
 * Collabmed Solutions Ltd
 * Project: Collabmed Health Platform
 * Author: Samuel Okoth <sodhiambo@collabmed.com>
 *
 * =============================================================================
 */

namespace Ignite\Core\Providers;

use Config;
use Ignite\Core\Console\PublishModuleAssetsCommand;
use Illuminate\Support\ServiceProvider;
use Ignite\Core\Console\InstallCommand;
use Ignite\Core\Console\PublishThemeAssetsCommand;
use Ignite\Core\Foundation\Theme\ThemeManager;

class CoreServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * @var string
     */
    protected $prefix = 'dervis';

    /**
     * The filters base class name.
     *
     * @var array
     */
    protected $middleware = [
        'Core' => [
            'permissions' => 'PermissionMiddleware',
            'auth.admin' => 'AdminMiddleware',
            'public.checkLocale' => 'PublicMiddleware',
            'can' => 'AuthorizationMiddleware',
        ],
    ];

    /**
     * Boot the application events.
     *
     */
    public function boot() {
        $this->registerMiddlewares();
        $this->registerModuleResourceNamespaces();
        $this->registerTranslations();
        // $this->registerConfig();
        //$this->registerViews();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->app->singleton('system.isInstalled', function ($app) {
            $envFileLocation = "{$app->environmentPath()}/{$app->environmentFile()}";
            $hasTable = true;
            /*
              try {
              $hasTable = Schema::hasTable('setting__settings');
              } catch (\Exception $e) {
              $hasTable = false;
              }
             */
            return $app['files']->isFile($envFileLocation) && $hasTable;
        });

        $this->registerCommands();
        $this->registerServices();
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig() {
        $this->publishes([
            __DIR__ . '/../Config/config.php' => config_path('core.php'),
        ]);
        $this->mergeConfigFrom(
                __DIR__ . '/../Config/config.php', 'core'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews() {
        $viewPath = base_path('resources/views/modules/core');

        $sourcePath = __DIR__ . '/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
                            return $path . '/modules/core';
                        }, Config::get('view.paths')), [$sourcePath]), 'core');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations() {
        $langPath = base_path('resources/lang/modules/core');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'core');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'core');
        }
    }

    /**
     * Register the console commands
     */
    private function registerCommands() {
        $this->commands([
            InstallCommand::class,
            PublishThemeAssetsCommand::class,
            PublishModuleAssetsCommand::class,
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return [];
    }

    private function registerMiddlewares() {
        foreach ($this->middleware as $module => $middlewares) {
            foreach ($middlewares as $name => $middleware) {
                $class = "Ignite\\{$module}\\Http\\Middleware\\{$middleware}";
                $this->app['router']->middleware($name, $class);
            }
        }
    }

    private function registerModuleResourceNamespaces() {
        foreach ($this->app['modules']->getOrdered() as $module) {
            $this->registerViewNamespace($module);
            $this->registerConfigNamespace($module);
        }
    }

    /**
     * Register the view namespaces for the modules
     * @param Module $module
     */
    protected function registerViewNamespace($module) {
        if ($module->getName() == 'user') {
            return;
        }
        $this->app['view']->addNamespace(
                $module->getName(), $module->getPath() . '/Resources/views'
        );
    }

    /**
     * Register the config namespace
     * @param Module $module
     */
    private function registerConfigNamespace($module) {
        $files = $this->app['files']->files($module->getPath() . '/Config');

        $package = $module->getLowerName();

        foreach ($files as $file) {
            $filename = $this->getConfigFilename($file, $package);

            $this->mergeConfigFrom($file, $filename);

            $this->publishes([$file => config_path($filename . '.php'),], 'config');
        }
    }

    /**
     * @param $file
     * @param $package
     * @return string
     */
    private function getConfigFilename($file, $package) {
        $name = preg_replace('/\\.[^.\\s]{3,4}$/', '', basename($file));

        $filename = $this->prefix . '.' . $package . '.' . $name;

        return $filename;
    }

    private function registerServices() {
        $this->app->singleton(ThemeManager::class, function ($app) {
            $path = mconfig('core.core.themes_path');
            //$path = $app['config']->get('asgard.core.core.themes_path');

            return new ThemeManager($app, $path);
        });
    }

}
