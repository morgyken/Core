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
Route::group(['prefix' => 'users',
    'middleware' => mconfig('core.core.middleware.api'),
    'namespace' => $namespace,
    'as' => 'core.api.'], function () {

});

//temporal medias
Route::group(['prefix' => 'users',
    'middleware' => mconfig('core.core.middleware.api'),
    'namespace' => $namespace,], function () {
    Route::post('file', ['uses' => 'MediaController@store', 'as' => 'api.media.store']);
    Route::post('media/link', ['uses' => 'MediaController@linkMedia', 'as' => 'api.media.link']);
    Route::post('media/unlink', ['uses' => 'MediaController@unlinkMedia', 'as' => 'api.media.unlink']);
    Route::get('media/all', ['uses' => 'MediaController@all', 'as' => 'api.media.all',]);
    Route::post('media/sort', ['uses' => 'MediaController@sortMedia', 'as' => 'api.media.sort']);
});
