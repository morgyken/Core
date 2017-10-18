<?php

namespace Ignite\Core\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the package's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        parent::schedule($schedule);
        $schedule->command('system:sync')->everyThirtyMinutes(); //->at('01:00');
        $schedule->command('backup:clean')->daily(); //->at('01:00');
        $schedule->command('backup:run --only-db')->daily(); //->at('01:00');
    }
}