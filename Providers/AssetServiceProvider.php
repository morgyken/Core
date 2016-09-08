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

namespace Modules\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Foundation\Asset\Manager\AssetManager;
use Modules\Core\Foundation\Asset\Manager\DervisAssetManager;
use Modules\Core\Foundation\Asset\Pipeline\AssetPipeline;
use Modules\Core\Foundation\Asset\Pipeline\DervisAssetPipeline;

/**
 * Class AssetServiceProvider
 * @package Modules\Core\Providers
 */
class AssetServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     * @return void
     */
    public function register() {
        $this->bindAssetClasses();
    }

    /**
     * Bind classes related to assets
     */
    private function bindAssetClasses() {
        $this->app->singleton(AssetManager::class, function () {
            return new DervisAssetManager();
        });

        $this->app->singleton(AssetPipeline::class, function ($app) {
            return new DervisAssetPipeline($app[AssetManager::class]);
        });
    }

}
