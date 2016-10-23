<?php

namespace Ignite\Core\Providers;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;

class SchedulerServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    public function boot() {
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $enabled = \Module::enabled();
            foreach ($enabled as $module) {
                $paths = config('modules.paths.modules') . '/' . studly_case($module->get('name')) . '/Console/schedules.php';
                if (file_exists($paths)) {
                    require_once $paths;
                }
            }
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return [];
    }

}
