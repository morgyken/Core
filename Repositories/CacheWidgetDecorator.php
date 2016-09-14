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
 * Description of CacheWidgetDecorator
 *
 * @author samuel
 */
class CacheWidgetDecorator extends BaseCacheDecorator implements WidgetRepository {

    public function __construct(WidgetRepository $widgets) {
        parent::__construct();
        $this->entityName = 'dashboard.widgets';
        $this->repository = $widgets;
    }

    /**
     * Find the saved state of widgets for the given user id
     * @param int $userId
     * @return string
     */
    public function findForUser($userId) {
        return $this->cache
                        ->tags($this->entityName, 'global')
                        ->remember("{$this->locale}.{$this->entityName}.findForUser.{$userId}", $this->cacheTime, function () use ($userId) {
                            return $this->repository->findForUser($userId);
                        }
        );
    }

    /**
     * Update or create the given widgets for given user
     * @param array $widgets
     * @return void
     */
    public function updateOrCreateForUser($widgets, $userId) {
        return $this->cache
                        ->tags($this->entityName, 'global')
                        ->remember("{$this->locale}.{$this->entityName}.updateOrCreateForUser.{$userId}", $this->cacheTime, function () use ($widgets, $userId) {
                            return $this->repository->updateOrCreateForUser($widgets, $userId);
                        }
        );
    }

}
