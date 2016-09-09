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

use Exception;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Ignite\Core\Console\Installers\SetupScript;

class ProtectInstaller implements SetupScript {

    /**
     * @var Filesystem
     */
    protected $finder;

    /**
     * @param Filesystem $finder
     */
    public function __construct(Filesystem $finder) {
        $this->finder = $finder;
    }

    /**
     * Fire the install script
     * @param  Command   $command
     * @return mixed
     * @throws Exception
     */
    public function fire(Command $command) {
        if ($this->finder->isFile('.env') && !$command->option('force')) {
            throw new Exception('iClinic <Collabmed> has already been installed. You can already log into your administration.');
        }
        if ($command->option('careless')) {
            $command->blockMessage('Database', 'Checking database', 'comment');
            $command->error('All previous data will be lost');
            $mysqli = new \mysqli(env('DB_HOST'), env('DB_USERNAME'), env('DB_PASSWORD'));
            $command->info('Drop existing database');
            $mysqli->query('drop database if exists ' . env('DB_DATABASE'));
            $command->info('Creating new database');
            $mysqli->query('create database ' . env('DB_DATABASE'));
            $command->info('...done!');
            $mysqli->close();
        }
    }

}
