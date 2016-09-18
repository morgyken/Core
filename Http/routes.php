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
Route::group([ 'namespace' => 'Ignite\Core\Http\Controllers',
    'middleware' => mconfig('core.core.middleware.backend'),], function () {
    Route::get('/', ['as' => 'dashboard', 'uses' => 'DashboardController@index',]);
});


Route::group(['prefix' => '/dashboard', 'namespace' => 'Ignite\Core\Http\Controllers',], function () {
    Route::post('grid', ['as' => 'dashboard.grid.save', 'uses' => 'DashboardController@save']);
    Route::get('grid', ['as' => 'dashboard.grid.reset', 'uses' => 'DashboardController@reset']);
});
///temporal media container
Route::group(['prefix' => '/media', 'namespace' => 'Ignite\Core\Http\Controllers'], function () {
    Route::get('media', ['as' => 'admin.media.media.index', 'uses' => 'CoreController@index']);
    Route::get('media/create', ['as' => 'admin.media.media.create', 'uses' => 'CoreController@create']);
    Route::post('media', ['as' => 'admin.media.media.store', 'uses' => 'CoreController@store']);
    Route::get('media/{media}/edit', ['as' => 'admin.media.media.edit', 'uses' => 'CoreController@edit']);
    Route::put('media/{media}', ['as' => 'admin.media.media.update', 'uses' => 'CoreController@update']);
    Route::delete('media/{media}', ['as' => 'admin.media.media.destroy', 'uses' => 'CoreController@destroy']);

    Route::get('media-grid/index', ['uses' => 'CoreController@index', 'as' => 'media.grid.select']);
    Route::get('media-grid/ckIndex', ['uses' => 'CoreController@ckIndex', 'as' => 'media.grid.ckeditor']);
});
