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

/** @var  \Illuminate\Routing\Router $router */

use Illuminate\Routing\Router;

$router->group(['prefix' => 'dashboard',], function (Router $router) {
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


//notifications
$router->group(['prefix' => 'notification', 'as' => 'notification.'], function (Illuminate\Routing\Router $router) {
    $router->get('/', ['as' => 'index', 'uses' => 'NotificationsController@index']);
    $router->get('mark-all-read', ['as' => 'mark-all-read', 'uses' => 'NotificationsController@markAllAsRead']);
    $router->delete('delete-all', ['as' => 'delete-all', 'uses' => 'NotificationsController@destroyAll']);
    $router->delete('delete/{notification}', ['as' => 'delete', 'uses' => 'NotificationsController@destroy']);
});
