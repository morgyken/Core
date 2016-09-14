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

namespace Ignite\Core\Repositories;

/**
 * Description of WidgetRepository
 *
 * @author samuel
 */
interface WidgetRepository extends BaseRepository {

    /**
     * Find the saved state of widgets for the given user id
     * @param int $userId
     * @return string
     */
    public function findForUser($userId);

    /**
     * Update or create the given widgets for given user
     * @param array $widgets
     * @return void
     */
    public function updateOrCreateForUser($widgets, $userId);
}
