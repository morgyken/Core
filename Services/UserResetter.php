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

namespace Modules\Core\Services;

use Modules\Core\Contracts\Authentication;
use Modules\Core\Events\UserHasBegunResetProcess;
use Modules\Core\Exceptions\InvalidOrExpiredResetCode;
use Modules\Core\Exceptions\UserNotFoundException;
use Modules\Core\Repositories\UserRepository;

/**
 * Description of UserResetter
 *
 * @author Samuel Dervis <samueldervis@gmail.com>
 */
class UserResetter {

    /**
     * @var UserRepository
     */
    private $user;

    /**
     * @var Authentication
     */
    private $auth;

    public function __construct(UserRepository $user, Authentication $auth) {
        $this->user = $user;
        $this->auth = $auth;
    }

    /**
     * Start the reset password process for given credentials (email)
     * @param array $credentials
     * @throws UserNotFoundException
     */
    public function startReset(array $credentials) {
        $user = $this->findUser(array_only($credentials, 'email'));
        $code = $this->auth->createReminderCode($user);

        event(new UserHasBegunResetProcess($user, $code));
    }

    /**
     * Finish the reset process
     * @param array $data
     * @return mixed
     * @throws InvalidOrExpiredResetCode
     * @throws UserNotFoundException
     */
    public function finishReset(array $data) {
        $user = $this->user->find(array_get($data, 'userId'));

        if ($user === null) {
            throw new UserNotFoundException();
        }

        $code = array_get($data, 'code');
        $password = array_get($data, 'password');
        if (!$this->auth->completeResetPassword($user, $code, $password)) {
            throw new InvalidOrExpiredResetCode();
        }

        return $user;
    }

    /**
     * @param array $credentials
     * @return mixed
     * @throws UserNotFoundException
     */
    private function findUser(array $credentials) {
        $the_user_id = \Modules\Core\Entities\User::firstOrNew($credentials)->id;
        $user = $this->user->find($the_user_id);
        if ($user === null) {
            throw new UserNotFoundException();
        }

        return $user;
    }

}
