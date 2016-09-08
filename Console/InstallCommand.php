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

use Modules\Core\Console\Installers\Installer;
use Modules\Core\Console\Installers\Scripts\ConfigureUserProvider;
use Modules\Core\Console\Installers\Scripts\HouseKeeping;
use Modules\Core\Console\Installers\Scripts\ModuleAssets;
use Modules\Core\Console\Installers\Scripts\ModuleMigrator;
use Modules\Core\Console\Installers\Scripts\ModuleSeeders;
use Modules\Core\Console\Installers\Scripts\ProtectInstaller;
use Modules\Core\Console\Installers\Scripts\SetAppKey;
use Illuminate\Console\Command;
use Modules\Core\Console\Installers\Scripts\ConfigureDatabase;
use Modules\Core\Console\Installers\Scripts\ThemeAssets;
use Modules\Core\Console\Installers\Traits\BlockMessage;
use Modules\Core\Console\Installers\Traits\SectionMessage;
use Symfony\Component\Console\Input\InputOption;

class InstallCommand extends Command {

    use BlockMessage,
        SectionMessage;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'system:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Collabmed V2 via console';

    /**
     * @var Installer
     */
    private $installer;

    /**
     * Create a new command instance.
     *
     * @param Installer $installer
     * @internal param Filesystem $finder
     * @internal param Application $app
     * @internal param Composer $composer
     */
    public function __construct(Installer $installer) {
        parent::__construct();
        $this->getLaravel()['env'] = 'local';
        $this->installer = $installer;
    }

    /**
     * Execute the actions
     *
     * @return mixed
     */
    public function fire() {
        $this->blockMessage('Welcome!', 'Starting the installation process...', 'comment');

        $success = $this->installer->stack([
                    ProtectInstaller::class,
                    ConfigureDatabase::class,
                    SetAppKey::class,
                    ModuleMigrator::class,
                    ModuleSeeders::class,
                    ModuleAssets::class,
                    ThemeAssets::class,
                    //UnignoreComposerLock::class,
                    ConfigureUserProvider::class,
                    HouseKeeping::class,
                ])->install($this);

        if ($success) {
            $this->info('Collabmed health Platform ready! You can now login with your username and password');
        }
    }

    protected function getOptions() {
        return [
            ['force', 'f', InputOption::VALUE_NONE, 'Force the installation, even if already installed'],
            ['careless', 'c', InputOption::VALUE_NONE, 'Destroy current data and start a fresh'],
            ['seed', 's', InputOption::VALUE_NONE, 'Install sample data in application'],
        ];
    }

}
