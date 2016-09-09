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

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Ignite\Core\Contracts\Authentication;

abstract class BasePublicController extends Controller {

    /**
     * @var Authentication
     */
    protected $auth;
    public $locale;

    public function __construct() {
        $this->locale = App::getLocale();
        $this->auth = app(Authentication::class);
        view()->share('currentUser', $this->auth->check());
    }

}
