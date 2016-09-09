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
use Ignite\Core\Foundation\Theme\ThemeManager;

/**
 * Description of ThemeComposer
 *
 * @author samuel
 */
class ThemeComposer {

    /**
     * @var ThemeManager
     */
    private $themeManager;

    public function __construct(ThemeManager $themeManager) {
        $this->themeManager = $themeManager;
    }

    public function compose(View $view) {
        $view->with('themes', $this->themeManager->allPublicThemes());
    }

}
