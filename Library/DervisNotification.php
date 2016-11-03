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

namespace Ignite\Core\Library;

use Ignite\Core\Contracts\Authentication;
use Ignite\Messaging\Entities\Notification;
use Ignite\Messaging\Events\BroadcastNotification;
use Ignite\Messaging\Repositories\NotificationRepository;

/**
 * Description of DervisNotification
 *
 * @author samuel
 */
final class DervisNotification implements NotificationService {

    /**
     * @var NotificationRepository
     */
    private $notification;

    /**
     * @var Authentication
     */
    private $auth;

    /**
     * @var int
     */
    private $userId;

    public function __construct(NotificationRepository $notification, Authentication $auth) {
        $this->notification = $notification;
        $this->auth = $auth;
    }

    /**
     * Push a notification on the dashboard
     * @param string $title
     * @param string $message
     * @param string $icon
     * @param string|null $link
     */
    public function push($title, $message, $icon, $link = null) {
        $notification = $this->notification->create([
            'user_id' => $this->userId ?: $this->auth->check()->id,
            'icon_class' => $icon,
            'link' => $link,
            'title' => $title,
            'message' => $message,
        ]);
        if (\Setting::get('messaging:real-time')) {
            $this->triggerEventFor($notification);
        }
    }

    /**
     * Trigger the broadcast event for the given notification
     * @param Notification $notification
     */
    private function triggerEventFor(Notification $notification) {
        event(new BroadcastNotification($notification));
    }

    /**
     * Set a user id to set the notification to
     * @param int $userId
     * @return $this
     */
    public function to($userId) {
        $this->userId = $userId;
        return $this;
    }

}
