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

use FloatingPoint\Stylist\Theme\Theme;
use Ignite\Core\Library\ThemeManager;

class ThemesController extends AdminBaseController {

    /**
     * @var ThemeManager
     */
    private $themeManager;

    public function __construct(ThemeManager $themeManager) {
        parent::__construct();

        $this->themeManager = $themeManager;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index() {
        $this->data['themes'] = $this->themeManager->all();
        return view('core::themes.index', ['data' => $this->data]);
    }

    /**
     * @param Theme $theme
     * @return \Illuminate\View\View
     */
    public function show($theme) {
        $this->data['theme'] = $this->themeManager->find($theme);
        return view('core::themes.show', ['data' => $this->data]);
    }

}
