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
use Illuminate\Support\Facades\Artisan;
use InvalidArgumentException;

class ApiController extends Controller {

    /**
     * @param $module
     * @return array
     */
    public function publishModuleAssets($module) {
        try {
            Artisan::call('module:publish', ['module' => $module]);
            $results = true;
        } catch (InvalidArgumentException $e) {
            $results = false;
        }
        return ['result' => $results];
    }

    /**
     * @param $module
     * @return array
     */
    public function publishThemeAssets($module) {
        try {
            Artisan::call('stylist:publish', ['theme' => $module]);
            $results = true;
        } catch (InvalidArgumentException $e) {
            $results = false;
        }
        return ['result' => $results];
    }

}
