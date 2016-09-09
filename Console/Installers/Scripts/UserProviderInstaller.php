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

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Ignite\Core\Entities\UserProfile;
use Ignite\Core\Repositories\UserRepository;
use Illuminate\Console\Command;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Filesystem\Filesystem;
use Ignite\Core\Console\Installers\SetupScript;
use Ignite\Core\Services\Composer;

abstract class UserProviderInstaller implements SetupScript {

    /**
     * @var string
     */
    protected $driver;

    /**
     * @var Command
     */
    protected $command;

    /**
     * @var Filesystem
     */
    protected $finder;

    /**
     * @var Composer
     */
    protected $composer;

    /**
     * @var Application
     */
    protected $application;

    /**
     * @param Filesystem     $finder
     * @param Composer       $composer
     * @param Application    $application
     */
    public function __construct(Filesystem $finder, Composer $composer, Application $application) {
        $this->finder = $finder;
        $this->composer = $composer;
        $this->application = $application;
        $this->application['env'] = 'local';
    }

    /**
     * Fire the install script
     * @param  Command $command
     * @return mixed
     */
    public function fire(Command $command) {
        $this->command = $command;

        //  $this->command->call('vendor:publish', ['--provider' => 'Ignite\Core\Providers\CoreServiceProvider']);

        if (!$this->checkIsInstalled()) {
            return $this->command->error('No user driver was installed. Please check the presence of a Service Provider');
        }
        //$this->publish();
        $this->configure();
        // $this->migrate();
        //$this->seed();
        if ($this->command->confirm('Do you wish to create your account? [y|N]')) {
            $this->createFirstUser();
        }
        //$command->info($this->driver . ' succesfully configured');
    }

    /**
     * @return mixed
     */
    abstract public function composer();

    /**
     * Check if the user driver is correctly registered.
     * @return bool
     */
    abstract public function checkIsInstalled();

    /**
     * @return mixed
     */
    abstract public function publish();

    /**
     * @return mixed
     */
    abstract public function migrate();

    /**
     * @return mixed
     */
    abstract public function seed();

    /**
     * @return mixed
     */
    abstract public function configure();

    /**
     * @param $password
     * @return mixed
     */
    abstract public function getHashedPassword($password);

    /**
     * @param $search
     * @param $Driver
     */
    protected function replaceCartalystUserModelConfiguration($search, $Driver) {
        $driver = strtolower($Driver);

        $path = base_path("config/cartalyst.{$driver}.php");

        $config = $this->finder->get($path);

        $config = str_replace($search, "Ignite\\User\\Entities\\{$Driver}\\User", $config);

        $this->finder->put($path, $config);
    }

    /**
     * Set the correct repository binding on the fly for the current request
     *
     * @param $driver
     */
    protected function bindUserRepositoryOnTheFly($driver) {
        $this->application->bind(
                'Ignite\Core\Repositories\UserRepository', "Ignite\\Core\\Repositories\\{$driver}UserRepository"
        );
        $this->application->bind(
                'Ignite\User\Repositories\RoleRepository', "Ignite\\Core\\Repositories\\{$driver}RoleRepository"
        );
        $this->application->bind(
                'Ignite\Core\Contracts\Authentication', "Ignite\\Core\\Repositories\\{$driver}Authentication"
        );
    }

    /**
     * Create a first admin user
     */
    protected function createFirstUser() {
        $info = [
            'first_name' => ucfirst($this->askForFirstName()),
            'last_name' => ucfirst($this->askForLastName()),
        ];
        $user = [
            'username' => strtolower($this->askForUsername()),
            'password' => $this->getHashedPassword($this->askForPassword()),
            'email' => $this->askForEmail(),
        ];
        $this->application->make(UserRepository::class)->createWithRolesFromCli($user, [1], true);
        $this->registerProfile($user, $info);
        $this->command->warn('-------------------------------------------------------------------------');
        $this->command->info('Creating account for ' . $user['username'] . ' --> with admin privilleges');
        $this->command->info('Hello  ' . $info['first_name'] . ' ' . $info['last_name']);
        $this->command->warn("-------------------------------------------------------------------------");
    }

    protected function registerProfile(array $user, array $profile) {
        $profiles = new UserProfile; //::firstOrcreate($profile);
        $profiles->user_id = Sentinel::findByCredentials($user)->id;
        $profiles->first_name = $profile['first_name'];
        $profiles->last_name = $profile['last_name'];
        return $profiles->save();
    }

    /**
     * @return string
     */
    private function askForFirstName() {
        do {
            $firstname = $this->command->ask('Enter your first name');
            if ($firstname == '') {
                $this->command->error('First name is required');
            }
        } while (!$firstname);

        return $firstname;
    }

    private function askForUsername() {
        do {
            $username = $this->command->ask('Choose a username');
            if ($username == '') {
                $this->command->error('Username is required');
            }
        } while (!$username);

        return $username;
    }

    /**
     * @return string
     */
    private function askForLastName() {
        do {
            $lastname = $this->command->ask('Enter your last name');
            if ($lastname == '') {
                $this->command->error('Last name is required');
            }
        } while (!$lastname);

        return $lastname;
    }

    /**
     * @return string
     */
    private function askForEmail() {
        do {
            $email = $this->command->ask('Enter your email address');
            if ($email == '') {
                $this->command->error('Email is required');
            }
        } while (!$email);

        return $email;
    }

    /**
     * @return string
     */
    private function askForPassword() {
        do {
            $password = $this->askForFirstPassword();
            $passwordConfirmation = $this->askForPasswordConfirmation();
            if ($password != $passwordConfirmation) {
                $this->command->error('Password confirmation doesn\'t match. Please try again.');
            }
        } while ($password != $passwordConfirmation);

        return $password;
    }

    /**
     * @return string
     */
    private function askForFirstPassword() {
        do {
            $password = $this->command->secret('Enter a password');
            if ($password == '') {
                $this->command->error('Password is required');
            }
        } while (!$password);

        return $password;
    }

    /**
     * @return string
     */
    private function askForPasswordConfirmation() {
        do {
            $passwordConfirmation = $this->command->secret('Please confirm your password');
            if ($passwordConfirmation == '') {
                $this->command->error('Password confirmation is required');
            }
        } while (!$passwordConfirmation);

        return $passwordConfirmation;
    }

}
