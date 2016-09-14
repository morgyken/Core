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
use Illuminate\Support\Facades\Auth;

/**
 * Class CurrentUserViewComposer
 * @package Ignite\Core\Composers
 */
class CurrentUserViewComposer {

    /**
     * @param View $view
     */
    public function compose(View $view) {
        $view->with('user', Auth::user());
    }

}
