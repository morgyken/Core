<?php

namespace Ignite\Core\Console\Installers\Scripts;


use Ignite\Core\Console\Installers\SetupScript;
use Illuminate\Console\Command;

class TemplateInstaller implements SetupScript
{

    /**
     * Fire the install script
     * @param  Command $command
     * @return mixed
     */
    public function fire(Command $command)
    {
        if ($command->option('templates')) {
            $command->blockMessage('Templates', 'Importing templates', 'comment');
            $mysqli = new \mysqli(env('DB_HOST'), env('DB_USERNAME'), env('DB_PASSWORD'), env('DB_DATABASE'));
            $file = module_path('Evaluation') . '/Database/lab.sql';
            $mysqli->query('SET FOREIGN_KEY_CHECKS=0;');
            if ($fp = file_get_contents($file)) {
                $mysqli->query($fp);
                dd($mysqli->error);
            }
            $mysqli->query('SET FOREIGN_KEY_CHECKS=0;');
            $command->info('...done!');
            $mysqli->close();
        }
    }
}