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

class ModuleAssets implements SetupScript {

    /**
     * @var array
     */
    protected $modules = [
        'Core',
        'Notification',
    ];

    /**
     * Fire the install script
     * @param  Command $command
     * @return mixed
     */
    public function fire(Command $command) {
        $command->blockMessage('Module assets', 'Publishing module assets ...', 'comment');
        $command->call('module:publish');
        /*   foreach ($this->modules as $module) {
          $command->call('module:publish', ['module' => $module]);
          } */
    }

}
