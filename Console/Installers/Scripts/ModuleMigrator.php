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

namespace Ignite\Core\Console\Installers\Scripts;

use Illuminate\Console\Command;
use Ignite\Core\Console\Installers\SetupScript;

class ModuleMigrator implements SetupScript {

    /**
     * Fire the install script
     * @param  Command $command
     * @return mixed
     */
    public function fire(Command $command) {
        $command->blockMessage('Migrations', 'Starting the module migrations ...', 'comment');
        foreach (\Module::getOrdered() as $module) {
            $command->info("***** [" . $module->getName() . "] ****");
            $command->call('module:migrate', ['module' => $module->getName()]);
        }
    }

}
