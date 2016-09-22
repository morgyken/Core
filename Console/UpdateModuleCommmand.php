<?php

namespace Ignite\Core\Console;

use Ignite\Core\Services\Composer;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class UpdateModuleCommmand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'system:module:update';

    /**
     * @var string
     */
    protected $vendor = 'collabmed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the given module.';

    /**
     * @var Composer
     */
    private $composer;

    /**
     * Create a new command instance.
     *
     * @param Composer $composer
     */
    public function __construct(Composer $composer) {
        parent::__construct();
        $this->composer = $composer;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire() {
        $packageName = $this->getModulePackageName($this->argument('module'));
        $this->composer->enableOutput($this);
        $this->composer->update($packageName);
    }

    /**
     * Make the full package name for the given module name
     * @param string $module
     * @return string
     */
    private function getModulePackageName($module) {
        return $this->vendor . "/" . $module;
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments() {
        return [
            ['module', InputArgument::REQUIRED, 'The module name'],
        ];
    }

}
