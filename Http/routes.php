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
Route::group(['prefix' => '/media'], function () {
    Route::get('media', ['as' => 'admin.media.media.index', 'uses' => 'MediaController@index']);
    Route::get('media/create', ['as' => 'admin.media.media.create', 'uses' => 'MediaController@create']);
    Route::post('media', ['as' => 'admin.media.media.store', 'uses' => 'MediaController@store']);
    Route::get('media/{media}/edit', ['as' => 'admin.media.media.edit', 'uses' => 'MediaController@edit']);
    Route::put('media/{media}', ['as' => 'admin.media.media.update', 'uses' => 'MediaController@update']);
    Route::delete('media/{media}', ['as' => 'admin.media.media.destroy', 'uses' => 'MediaController@destroy']);

    Route::get('media-grid/index', ['uses' => 'MediaGridController@index', 'as' => 'media.grid.select']);
    Route::get('media-grid/ckIndex', ['uses' => 'MediaGridController@ckIndex', 'as' => 'media.grid.ckeditor']);
});
