<?php

namespace Ignite\Core\Console;

use Ignite\Core\Library\Sync;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RunSync extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'system:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Handle website synchronisation.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->callSilent('backup:run', ['--only-db' => true]);
        $this->info('Trying to sync');
        $r_sync = new Sync($this);
        $r_sync->runSync(env('SYNC_TYPE', 'remote'));
    }

}
