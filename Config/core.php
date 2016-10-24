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
return [
    /*
      |--------------------------------------------------------------------------
      | The prefix that'll be used for the administration
      |--------------------------------------------------------------------------
     */
    'admin-prefix' => 'backend',
    /*
      |--------------------------------------------------------------------------
      | Location where your themes are located
      |--------------------------------------------------------------------------
     */
    'themes_path' => base_path() . '/Themes',
    /*
      |--------------------------------------------------------------------------
      | Which administration theme to use for the back end interface
      |--------------------------------------------------------------------------
     */
    'admin-theme' => 'AdminLTE',
    /*
      |--------------------------------------------------------------------------
      | AdminLTE skin
      |--------------------------------------------------------------------------
      | You can customize the AdminLTE colors with this setting. The following
      | colors are available for you to use: skin-blue, skin-green,
      | skin-black, skin-purple, skin-red and skin-yellow.
     */
    'skin' => 'skin-blue',
    /*
      |--------------------------------------------------------------------------
      | Middleware
      |--------------------------------------------------------------------------
      | You can customise the Middleware that should be loaded.
      | The localizationRedirect middleware is automatically loaded for both
      | Backend and Frontend routes.
     */
    'middleware' => [
        'backend' => [
            'auth.admin',
            'setup'
        // 'permissions',
        ],
        'frontend' => ['guest'],
        //'api' => ['auth:api'],
        'api' => ['api'],
    ],
    /*
      |--------------------------------------------------------------------------
      | Define which assets will be available through the asset manager
      |--------------------------------------------------------------------------
      | These assets are registered on the asset manager
     */
    'admin-assets' => [
        // Css
        'bootstrap.css' => ['theme' => 'vendor/bootstrap/dist/css/bootstrap.min.css'],
        'font-awesome.css' => ['theme' => 'vendor/font-awesome/css/font-awesome.min.css'],
        'alertify.core.css' => ['theme' => 'css/vendor/alertify/alertify.core.css'],
        'alertify.default.css' => ['theme' => 'css/vendor/alertify/alertify.default.css'],
        'dataTables.bootstrap.css' => ['theme' => 'vendor/datatables.net-bs/css/dataTables.bootstrap.min.css'],
        'icheck.css' => ['theme' => 'vendor/iCheck/skins/all.css'],
        'AdminLTE.css' => ['theme' => 'vendor/admin-lte/dist/css/AdminLTE.css'],
        'AdminLTE.all.skins.css' => ['theme' => 'vendor/admin-lte/dist/css/skins/_all-skins.min.css'],
        'asgard.css' => ['theme' => 'css/asgard.min.css'],
        'custom.css' => ['theme' => 'css/custom.min.css'],
        'select2.css' => ['theme' => 'plugins/select2/select2.min.css'],
        'select2-bs.css' => ['theme' => 'plugins/select2/select2-bootstrap.min.css'],
        //'gridstack.css' => ['module' => 'core:vendor/gridstack/dist/gridstack.min.css'],
        'gridstack.css' => ['module' => 'core:gridstack/gridstack.min.css'],
        'daterangepicker.css' => ['theme' => 'vendor/admin-lte/plugins/daterangepicker/daterangepicker-bs3.css'],
        'selectize.css' => ['module' => 'core:vendor/selectize/dist/css/selectize.css'],
        'selectize-default.css' => ['module' => 'core:vendor/selectize/dist/css/selectize.default.css'],
        'animate.css' => ['theme' => 'vendor/animate.css/animate.min.css'],
        'pace.css' => ['theme' => 'vendor/admin-lte/plugins/pace/pace.min.css'],
        // Javascript
        'bootstrap.js' => ['theme' => 'vendor/bootstrap/dist/js/bootstrap.min.js'],
        'mousetrap.js' => ['theme' => 'js/vendor/mousetrap.min.js'],
        'alertify.js' => ['theme' => 'js/vendor/alertify/alertify.js'],
        'icheck.js' => ['theme' => 'vendor/iCheck/icheck.min.js'],
        'jquery.dataTables.js' => ['theme' => 'vendor/datatables.net/js/jquery.dataTables.min.js'],
        'dataTables.bootstrap.js' => ['theme' => 'vendor/datatables.net-bs/js/dataTables.bootstrap.min.js'],
        'jquery.slug.js' => ['theme' => 'js/vendor/jquery.slug.js'],
        'app.js' => ['theme' => 'vendor/admin-lte/dist/js/app.js'],
        'keypressAction.js' => ['module' => 'core:js/keypressAction.js'],
        'ckeditor.js' => ['theme' => 'js/vendor/ckeditor/ckeditor.js'],
        //'jquery-ui.js' => ['theme' => 'plugins/ui/jquery-ui.min.js'],
        'select2.js' => ['theme' => 'plugins/select2/select2.min.js'],
        'time.js' => ['theme' => 'plugins/time/jquery.timeAutocomplete.min.js'],
        'lodash.js' => ['module' => 'core:vendor/lodash/lodash.min.js'],
        'jquery-ui-core.js' => ['module' => 'core:vendor/jquery-ui/ui/minified/core.min.js'],
        'jquery-ui-widget.js' => ['module' => 'core:vendor/jquery-ui/ui/minified/widget.min.js'],
        'jquery-ui-mouse.js' => ['module' => 'core:vendor/jquery-ui/ui/minified/mouse.min.js'],
        'jquery-ui-draggable.js' => ['module' => 'core:vendor/jquery-ui/ui/minified/draggable.min.js'],
        'jquery-ui-resizable.js' => ['module' => 'core:vendor/jquery-ui/ui/minified/resizable.min.js'],
        'jquery-ui.js' => ['theme' => 'vendor/jquery-ui-new/jquery-ui.min.js'],
        'jquery-ui.css' => ['theme' => 'vendor/jquery-ui-new/jquery-ui.min.css'],
        //'gridstack.js' => ['module' => 'core:vendor/gridstack/dist/gridstack.min.js'],
        'gridstack.js' => ['module' => 'core:gridstack/gridstack.min.js'],
        'daterangepicker.js' => ['theme' => 'vendor/admin-lte/plugins/daterangepicker/daterangepicker.js'],
        'selectize.js' => ['module' => 'core:vendor/selectize/dist/js/standalone/selectize.min.js'],
        'sisyphus.js' => ['theme' => 'vendor/sisyphus/sisyphus.min.js'],
        'main.js' => ['theme' => 'js/main.js'],
        'chart.js' => ['theme' => 'vendor/admin-lte/plugins/chartjs/Chart.js'],
        'pace.js' => ['theme' => 'vendor/admin-lte/plugins/pace/pace.min.js'],
        'moment.js' => ['theme' => 'vendor/admin-lte/plugins/daterangepicker/moment.min.js'],
    ],
    /*
      |--------------------------------------------------------------------------
      | Define which default assets will always be included in your pages
      | through the asset pipeline
      |--------------------------------------------------------------------------
     */
    'admin-required-assets' => [
        'css' => [
            'bootstrap.css',
            'font-awesome.css',
            'alertify.core.css',
            'alertify.default.css',
            'dataTables.bootstrap.css',
            'icheck.css',
            'AdminLTE.css',
            'AdminLTE.all.skins.css',
            'animate.css',
            'pace.css',
            'asgard.css',
            'select2.css',
            'select2-bs.css',
            'jquery-ui.css',
            'custom.css'
        ],
        'js' => [
            'bootstrap.js',
            'mousetrap.js',
            'alertify.js',
            'icheck.js',
            'jquery.dataTables.js',
            'dataTables.bootstrap.js',
            'jquery.slug.js',
            //  'jquery-ui.js',
            'select2.js',
            'time.js',
            'keypressAction.js',
            'app.js',
            'pace.js',
            'main.js',
            'sisyphus.js',
            'jquery-ui.js',
            'selectize.js'
        ],
    ],
];
