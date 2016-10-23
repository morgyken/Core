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

/**
 * Description of HouseKeeping
 *
 * @author Samuel Dervis <samueldervis@gmail.com>
 */
class HouseKeeping implements SetupScript {

    /**
     * Fire the install script
     * @param  Command $command
     * @return mixed
     */
    public function fire(Command $command) {

        $command->blockMessage('Preparing', 'Preparing application ...', 'comment');
        $command->call('migrate', ['--seed' => true]);
        // $command->callSilent('module:update');
        //$command->call('ide-helper:models');
    }

}
