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

namespace Modules\Core\Http\Controllers;

use FloatingPoint\Stylist\Facades\ThemeFacade as Theme;
use Illuminate\Routing\Controller;
use Modules\Core\Foundation\Asset\Manager\AssetManager;
use Modules\Core\Foundation\Asset\Pipeline\AssetPipeline;
use Nwidart\Modules\Facades\Module;

class AdminBaseController extends Controller {

    /**
     * @var AssetManager
     */
    protected $assetManager;

    /**
     * @var AssetPipeline
     */
    public function __construct() {
        $this->assetManager = app(AssetManager::class);
        $this->assetPipeline = app(AssetPipeline::class);

        $this->addAssets();
        $this->requireDefaultAssets();
    }

    /**
     * Add the assets from the config file on the asset manager
     */
    private function addAssets() {
        $real_assets = mconfig('core.core.admin-assets');
        foreach ($real_assets as $assetName => $path) {

            if (key($path) == 'theme') {
                $this->assetManager->addAsset($assetName, Theme::url($path['theme']));
            } else {
                $this->assetManager->addAsset($assetName, Module::asset($path['module']));
            }
        }
    }

    /**
     * Require the default assets from config file on the asset pipeline
     */
    private function requireDefaultAssets() {
        $this->assetPipeline->requireCss(mconfig('core.core.admin-required-assets.css'));
        $this->assetPipeline->requireJs(mconfig('core.core.admin-required-assets.js'));
    }

    public function index() {
        dd($this->assetPipeline);
    }

}
