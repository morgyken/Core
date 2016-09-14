<?php

namespace Ignite\Core\Providers;

use Ignite\Core\Composers\DashboardWidgetViewComposer;
use Illuminate\Support\ServiceProvider;

class WidgetServiceProvider extends ServiceProvider {

    protected $defer = true;

    public function register() {
        $this->app->singleton(DashboardWidgetViewComposer::class, function () {
            return new DashboardWidgetViewComposer();
        });

        $this->app['view']->composer('dashboard::dashboard', DashboardWidgetViewComposer::class);
    }

}
