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
use Illuminate\Foundation\Application;
use Modules\Core\Console\Installers\SetupScript;

class ConfigureUserProvider implements SetupScript {

    /**
     * @var array
     */
    protected $drivers = [
        'Sentinel',
    ];

    /**
     * @var
     */
    private $application;

    /**
     * @param Application $application
     */
    public function __construct(Application $application) {
        $this->application = $application;
    }

    /**
     * Fire the install script
     * @param  Command $command
     * @return mixed
     */
    public function fire(Command $command) {
        $command->blockMessage('User Module', 'Configuring the User Module setup...', 'comment');
        $this->configure($command);
        $command->info('Done with user module, nice');
    }

    /**
     * @param $driver
     * @param $command
     * @return mixed
     */
    protected function configure($command) {
        $the_driver = $this->factory();
        return $the_driver->fire($command);
    }

    /**
     * @param $driver
     * @return mixed
     */
    protected function factory() {
        $class = __NAMESPACE__ . "\\SentinelInstaller";
        return $this->application->make($class);
    }

}
