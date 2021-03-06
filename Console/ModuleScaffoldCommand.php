<?php

namespace Ignite\Core\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ModuleScaffoldCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'system:module:scaffold';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold a new module.';

    /**
     * @var array
     */
    protected $entities = [];

    /**
     * @var array
     */
    protected $valueObjects = [];

    /**
     * @var string The type of entities to generate [Eloquent or Doctrine]
     */
    protected $entityType;

    /**
     * @var ModuleScaffold
     */
    private $moduleScaffold;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire() {
        //
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments() {
        return [
            ['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions() {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }

}
