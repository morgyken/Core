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

class ModuleSeeders implements SetupScript
{

    /**
     * @var array
     */
    protected $modules = [
        'Setup',
        'Users',
        'Core',
        'Settings',
    ];
    protected $secondary = [
        'Setup',
        'Notification',
        'Reception',
        'Evaluation',
        'Messaging',
        'Finance',
        'Inventory',
        'Core',
        'Users',
        'Settings',
    ];

    /**
     * Fire the install script
     * @param  Command $command
     * @return mixed
     */
    public function fire(Command $command)
    {
        $command->blockMessage('Seeds', 'Running the module seeds ...', 'comment');
//        foreach (\Module::getOrdered() as $module) {
//            $command->info("***** [" . $module->getName() . "] ****");
//            $command->call('module:seed', ['module' => $module->getName()]);
//        }

        if ($command->option('seed')) {
            $command->warn('Seeding extra data');
            foreach (\Module::getOrdered() as $module) {
                if (\Module::has($module)) {
                    $command->call('module:seed', ['module' => $module]);
                }
            }
        } else {
            $command->warn('Seeding few data');
            foreach ($this->modules as $module) {
                if (\Module::has($module)) {
                    $command->call('module:seed', ['module' => $module]);
                }
            }
        }
    }

}
