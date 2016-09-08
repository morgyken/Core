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

namespace Modules\Core\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class PublishThemeAssetsCommand extends Command {

    protected $name = 'system:publish:theme';
    protected $description = 'Publish theme assets';

    public function fire() {
        $theme = $this->argument('theme', null);

        if (!empty($theme)) {
            $this->call('stylist:publish', ['theme' => $this->argument('theme')]);
        } else {
            $this->call('stylist:publish');
        }
    }

    protected function getArguments() {
        return [
            ['theme', InputArgument::OPTIONAL, 'Name of the theme you wish to publish']
        ];
    }

}
