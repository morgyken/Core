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

namespace Modules\Core\Composers;

use Illuminate\Contracts\View\View;
use Modules\Core\Contracts\Authentication;

class CurrentUserViewComposer {

    /**
     * @var Authentication
     */
    private $auth;

    public function __construct(Authentication $auth) {
        $this->auth = $auth;
    }

    public function compose(View $view) {
        $view->with('user', $this->auth->check());
    }

}
