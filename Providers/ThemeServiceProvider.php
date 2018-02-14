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

use Ignite\Core\Library\StylistThemeManager;
use Ignite\Core\Library\ThemeManager;
use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider {

    protected $route_prefix = ['system'];

    /**
     * Register the service provider.
     * @return void
     */
    public function boot() {
        $this->app->booted(function () {
            $this->registerAllThemes();
            $this->setActiveTheme();
        });
        $this->bindThemeManager();
    }

    /**
     * Set the active theme based on the settings
     */
    private function setActiveTheme() {
        if ($this->app->runningInConsole() || !app('system.isInstalled')) {
            return;
        }
        if ($this->inAdministration()) {
            $themeName = mconfig('core.core.admin-theme');
            return $this->app['stylist']->activate($themeName, true);
        }
        $themeName = 'Flatly'; // $this->app['setting.settings']->get('core::template', null, 'Flatly');
        return $this->app['stylist']->activate($themeName, true);
    }

    /**
     * Check if we are in the administration
     * @return bool
     */
    private function inAdministration() {
        $ai = $this->app['request']->segment(1);
        if (empty($ai)) {
            return true;
        }
        return in_array($ai, $this->route_prefix) || \Module::has(ucfirst($ai));
        //return $this->app['request']->segment($segment) === $this->app['config']->get('asgard.core.core.admin-prefix');
    }

    /**
     * Register all themes with activating them
     */
    private function registerAllThemes() {
        $directories = $this->app['files']->directories(base_path('/Themes'));

        foreach ($directories as $directory) {
            $this->app['stylist']->registerPath($directory);
        }
    }

    /**
     * Bind the theme manager
     */
    private function bindThemeManager() {
        $this->app->singleton(ThemeManager::class, function ($app) {
            return new StylistThemeManager($app['files']);
        });
    }

}
