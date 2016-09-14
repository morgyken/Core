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

namespace Ignite\Core\Composers;

use Illuminate\Contracts\View\View;
use Ignite\Core\Foundation\Asset\Pipeline\AssetPipeline;
use Setting;

/**
 * Description of MasterViewComposer
 *
 * @author samuel
 */
class MasterViewComposer {

    /**
     * @var Setting
     */
    private $setting;

    /**
     * @var AssetPipeline
     */
    private $assetPipeline;

    public function __construct(Setting $setting, AssetPipeline $assetPipeline) {
        $this->setting = $setting;
        $this->assetPipeline = $assetPipeline;
    }

    public function compose(View $view) {
        $view->with('sitename', 'Collabmed');
        // $view->with('sitename', $this->setting->get('core::site-name', App::getLocale()));
        $view->with('cssFiles', $this->assetPipeline->allCss());
        $view->with('jsFiles', $this->assetPipeline->allJs());
    }

}
