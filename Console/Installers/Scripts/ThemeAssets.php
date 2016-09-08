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

/**
 * Description of ThemeAssets
 *
 * @author samuel
 */
class ThemeAssets {

    /**
     * Fire the install script
     * @param  Command $command
     * @return mixed
     */
    public function fire(Command $command) {
        $command->blockMessage('Themes', 'Publishing theme assets ...', 'comment');
        $command->option('verbose');
    }

}
