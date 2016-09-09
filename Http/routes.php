<?php

Route::group(['middleware' => 'web', 'prefix' => 'core', 'namespace' => 'Ignite\Core\Http\Controllers'], function() {
    Route::get('/', 'AdminBaseController@index');
});
