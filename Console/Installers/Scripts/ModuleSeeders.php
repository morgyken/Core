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

namespace Modules\Core\Console\Installers\Scripts;

use Illuminate\Console\Command;
use Modules\Core\Console\Installers\SetupScript;

class ModuleSeeders implements SetupScript {

    /**
     * @var array
     */
    protected $modules = [
        'Core',
    ];
    protected $secondary = [
        'Setup',
        'Notification',
        'Reception',
        'Evaluation',
        'Messaging',
        'Finance',
        'Inventory',
    ];

    /**
     * Fire the install script
     * @param  Command $command
     * @return mixed
     */
    public function fire(Command $command) {
        $command->blockMessage('Seeds', 'Running the module seeds ...', 'comment');
        foreach ($this->modules as $module) {
            if (is_module_enabled($module))
                $command->call('module:seed', ['module' => $module]);
        }
        if ($command->option('seed')) {
            $command->warn('Seeding extra data');
            foreach ($this->secondary as $module) {
                $command->call('module:seed', ['module' => $module]);
            }
        }
    }

}
