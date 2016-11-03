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

namespace Ignite\Core\Composers;

use Ignite\Core\Contracts\Authentication;
use Ignite\Core\Repositories\NotificationRepository;
use Illuminate\Contracts\View\View;

/**
 * Description of NotificationsViewComposer
 *
 * @author samuel
 */
class NotificationsViewComposer {

    /**
     * @var NotificationRepository
     */
    private $notification;

    /**
     * @var Authentication
     */
    private $auth;

    public function __construct(NotificationRepository $notification, Authentication $auth) {
        $this->notification = $notification;
        $this->auth = $auth;
    }

    public function compose(View $view) {
        $notifications = $this->notification->latestForUser($this->auth->check()->id);
        $view->with('notifications', $notifications);
    }

}
