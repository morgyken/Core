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

namespace Ignite\Core\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class PublishModuleAssetsCommand extends Command {

    protected $name = 'system:publish:module';
    protected $description = 'Publish module assets';

    public function fire() {
        $this->call('module:publish', ['module' => $this->argument('module')]);
    }

    protected function getArguments() {
        return [
            ['module', InputArgument::REQUIRED, 'The module name'],
        ];
    }

}
