<?php

namespace Ignite\Core\Providers;

use Ignite\Core\Composers\NotificationsViewComposer;
use Ignite\Core\Contracts\Authentication;
use Ignite\Core\Entities\Notification;
use Ignite\Core\Library\DervisNotification;
use Ignite\Core\Library\NotificationService;
use Ignite\Core\Repositories\CacheNotificationDecorator;
use Ignite\Core\Repositories\EloquentNotificationRepository;
use Ignite\Core\Repositories\NotificationRepository;
use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->registerBindings();
        $this->registerViewComposers();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return [];
    }

    private function registerBindings() {
        $this->app->bind(NotificationRepository::class, function () {
            $repository = new EloquentNotificationRepository(new Notification());
            if (!config('app.cache')) {
                return $repository;
            }
            return new CacheNotificationDecorator($repository);
        });
        $this->app->bind(NotificationService::class, function ($app) {
            return new DervisNotification($app[NotificationRepository::class], $app[Authentication::class]);
        });
    }

    private function registerViewComposers() {
        view()->composer('core::notification.notifications', NotificationsViewComposer::class);
    }

}
