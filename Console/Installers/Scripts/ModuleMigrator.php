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
     * @var array
     */
    protected $modules = [
        'Core',
        'Setup',
        'Notification',
        'Reception',
        'Finance',
        'Inventory',
        'Evaluation',
        'Messaging',
    ];

    /**
     * Fire the install script
     * @param  Command $command
     * @return mixed
     */
    public function fire(Command $command) {

        $command->blockMessage('Migrations', 'Starting the module migrations ...', 'comment');
        //dd(\Ignite\Core\Console\InstallCommand::$outa);
        //$bar = $this->output->createProgressBar(count($this->modules));
        foreach ($this->modules as $module) {
            if (is_module_enabled($module)) {
                $command->info("***** [$module] ****");
                $command->call('module:migrate', ['module' => $module]);
            }
            //  $bar->advance();
        }
        //$bar->finish();
    }

}
