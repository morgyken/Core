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

namespace Ignite\Core\Http\Controllers;

use FloatingPoint\Stylist\Facades\ThemeFacade as Theme;
use Ignite\Core\Foundation\Asset\Manager\AssetManager;
use Ignite\Core\Foundation\Asset\Pipeline\AssetPipeline;
use Illuminate\Routing\Controller;

class AdminBaseController extends Controller
{

    /**
     * @var AssetManager
     */
    protected $assetManager;

    /**
     * @var AssetPipeline|\Illuminate\Foundation\Application|mixed
     */
    protected $assetPipeline;

    /**
     * The application featured data
     * @var array
     */
    public $data = [];
    /** @var  array */
    public $input;

    /**
     * @var AssetPipeline
     */
    public function __construct()
    {
        $this->assetManager = app(AssetManager::class);
        $this->assetPipeline = app(AssetPipeline::class);
        $this->addAssets();
        $this->requireDefaultAssets();
        $this->search();
    }

    /**
     * Add the assets from the config file on the asset manager
     */
    private function addAssets()
    {
        $real_assets = mconfig('core.core.admin-assets');
        foreach ($real_assets as $assetName => $path) {
            if (key($path) == 'theme') {
                $this->assetManager->addAsset($assetName, Theme::url($path['theme']));
            } else {
                $this->assetManager->addAsset($assetName, m_asset($path['module']));
            }
        }
    }

    /**
     * Require the default assets from config file on the asset pipeline
     */
    private function requireDefaultAssets()
    {
        $this->assetPipeline->requireCss(mconfig('core.core.admin-required-assets.css'));
        $this->assetPipeline->requireJs(mconfig('core.core.admin-required-assets.js'));
    }

    /**
     * @return array
     */
    private function search()
    {
        $this->input = \request()->all();
        unset($this->input['_token']);
        if (empty($this->input['id'])) {
            unset($this->input['id']);
        }
    }
}
