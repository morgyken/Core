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

use Ignite\Core\Contracts\Authentication;

class CoreController extends AdminBaseController {

    protected $auth;

    public function __construct(Authentication $auth) {
        parent::__construct();
        $this->auth = $auth;
    }

    public function resolve() {
        dd($this->auth);
    }

}
