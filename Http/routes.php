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

$router->group(['prefix' => 'dashboard',], function (\Illuminate\Routing\Router $router) {
    $router->get('/', ['as' => 'dashboard', 'uses' => 'DashboardController@index',]);
    $router->post('grid', ['as' => 'dashboard.grid.save', 'uses' => 'DashboardController@save']);
    $router->get('grid', ['as' => 'dashboard.grid.reset', 'uses' => 'DashboardController@reset']);
});

$router->get('modules', ['as' => 'modules.index', 'uses' => 'ModulesController@index']);
$router->get('modules/{module}', ['as' => 'modules.show', 'uses' => 'ModulesController@show']);
$router->post('modules', ['as' => 'modules.save', 'uses' => 'ModulesController@save']);
$router->post('modules/update', ['as' => 'modules.update', 'uses' => 'ModulesController@update']);
$router->post('modules/disable/{module}', ['as' => 'modules.disable', 'uses' => 'ModulesController@disable']);
$router->post('modules/enable/{module}', ['as' => 'modules.enable', 'uses' => 'ModulesController@enable']);

$router->get('themes', ['as' => 'themes.index', 'uses' => 'ThemesController@index']);
$router->get('themes/{theme}', ['as' => 'themes.show', 'uses' => 'ThemesController@show']);

# Workbench
$router->get('workbench', ['as' => 'workbench.index', 'uses' => 'WorkbenchController@index']);
$router->post('generate', ['as' => 'workbench.generate', 'uses' => 'WorkbenchController@generate']);
$router->post('migrate', ['as' => 'workbench.migrate', 'uses' => 'WorkbenchController@migrate']);
$router->post('install', ['as' => 'workbench.install', 'uses' => 'WorkbenchController@install']);
$router->post('seed', ['as' => 'workbench.seed', 'uses' => 'WorkbenchController@seed']);

