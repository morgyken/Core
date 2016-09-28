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
Route::group([
    'namespace' => 'Ignite\Core\Http\Controllers',
    'middleware' => mconfig('core.core.middleware.backend'),
        ], function () {
    Route::get('/', ['as' => 'dashboard', 'uses' => 'DashboardController@index',]);
});


Route::group(['prefix' => 'dashboard', 'namespace' => 'Ignite\Core\Http\Controllers',], function () {
    Route::post('grid', ['as' => 'dashboard.grid.save', 'uses' => 'DashboardController@save']);
    Route::get('grid', ['as' => 'dashboard.grid.reset', 'uses' => 'DashboardController@reset']);
});

Route::group([
    'prefix' => 'system',
    'as' => 'system.',
    'namespace' => 'Ignite\Core\Http\Controllers',
    'middleware' => mconfig('core.core.middleware.backend'),
        ], function () {
    Route::get('modules', ['as' => 'modules.index', 'uses' => 'ModulesController@index']);
    Route::get('modules/{module}', ['as' => 'modules.show', 'uses' => 'ModulesController@show']);
    Route::post('modules', ['as' => 'modules.save', 'uses' => 'ModulesController@save']);
    Route::post('modules/update', ['as' => 'modules.update', 'uses' => 'ModulesController@update']);
    Route::post('modules/disable/{module}', ['as' => 'modules.disable', 'uses' => 'ModulesController@disable']);
    Route::post('modules/enable/{module}', ['as' => 'modules.enable', 'uses' => 'ModulesController@enable']);

    Route::get('themes', ['as' => 'themes.index', 'uses' => 'ThemesController@index']);
    Route::get('themes/{theme}', ['as' => 'themes.show', 'uses' => 'ThemesController@show']);

    # Workbench
    Route::get('workbench', ['as' => 'workbench.index', 'uses' => 'WorkbenchController@index']);
    Route::post('generate', ['as' => 'workbench.generate', 'uses' => 'WorkbenchController@generate']);
    Route::post('migrate', ['as' => 'workbench.migrate', 'uses' => 'WorkbenchController@migrate']);
    Route::post('install', ['as' => 'workbench.install', 'uses' => 'WorkbenchController@install']);
    Route::post('seed', ['as' => 'workbench.seed', 'uses' => 'WorkbenchController@seed']);
});
