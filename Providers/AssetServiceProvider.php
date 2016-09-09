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

use Illuminate\Support\ServiceProvider;
use Ignite\Core\Foundation\Asset\Manager\AssetManager;
use Ignite\Core\Foundation\Asset\Manager\DervisAssetManager;
use Ignite\Core\Foundation\Asset\Pipeline\AssetPipeline;
use Ignite\Core\Foundation\Asset\Pipeline\DervisAssetPipeline;

/**
 * Class AssetServiceProvider
 * @package Ignite\Core\Providers
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
