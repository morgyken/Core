<?php

namespace Ignite\Core\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class PublishAssets extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'system:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish theme and module assets';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->call('module:publish');
        $this->call('stylist:publish');
    }

}
