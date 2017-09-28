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
/** @var  \Illuminate\Routing\Router $router */
$router->post('system/modules/{module}/publish', ['as' => 'module.publish', 'uses' => 'ApiController@publishModuleAssets']);
$router->post('system/themes/{theme}/publish', ['as' => 'theme.publish', 'uses' => 'ApiController@publishThemeAssets']);
$router->post('mark-read', ['as' => 'mark-read', 'uses' => 'ApiController@markAsRead']);
