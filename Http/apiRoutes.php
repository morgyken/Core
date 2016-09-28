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
$namespace = 'Ignite\Core\Http\Controllers';

//back-end routes
Route::group(['prefix' => 'api/core',
    'middleware' => mconfig('core.core.middleware.api'),
    'namespace' => $namespace,
    'as' => 'api.core.'], function () {
    Route::post('system/modules/{module}/publish', ['as' => 'module.publish', 'uses' => 'ApiController@publishModuleAssets']);
    Route::post('system/themes/{theme}/publish', ['as' => 'theme.publish', 'uses' => 'ApiController@publishThemeAssets']);
});
