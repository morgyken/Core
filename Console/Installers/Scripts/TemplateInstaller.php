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
            $file = module_path('Evaluation') . '/Database/lab.sql';
            if ($fp = file_get_contents($file)) {
                $var_array = explode(';', $fp);
                foreach ($var_array as $value) {
                   \DB::raw($value . ';');
                }
            }
            $command->info('...done!');
        }
    }
}