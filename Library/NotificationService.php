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

/**
 * Description of NotificationService
 *
 * @author samuel
 */
interface NotificationService {

    /**
     * Push a notification on the dashboard
     * @param string $title
     * @param string $message
     * @param string $icon
     * @param string|null $link
     */
    public function push($title, $message, $icon, $link = null);

    /**
     * Set a user id to set the notification to a specific user
     * @param int $userId
     * @return $this
     */
    public function to($userId);
}
