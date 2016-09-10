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

//homepage
Route::group([ 'namespace' => 'Ignite\Core\Http\Controllers',], function () {
    Route::get('/', ['uses' => 'CoreController@reslove', 'as' => 'home']);
});
