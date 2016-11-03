<?php

namespace Ignite\Core\Http\Controllers;

use Ignite\Core\Contracts\Authentication;
use Ignite\Core\Entities\Notification;
use Ignite\Core\Repositories\NotificationRepository;
use Illuminate\Http\Response;

class NotificationsController extends AdminBaseController {

    /**
     * @var NotificationRepository
     */
    private $notification;

    /**
     * @var Authentication
     */
    private $auth;

    public function __construct(NotificationRepository $notification, Authentication $auth) {
        parent::__construct();
        $this->notification = $notification;
        $this->auth = $auth;
    }

    public function index() {
        $notifications = $this->notification->allForUser($this->auth->check()->id);
        return view('core::notification.index', compact('notifications'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Notification $notification
     * @return Response
     */
    public function destroy(Notification $notification) {
        $this->notification->destroy($notification);
        flash()->success('Notification deleted');
        return redirect()->route('system.notification.index');
    }

    public function destroyAll() {
        $this->notification->deleteAllForUser($this->auth->check()->id);
        flash()->warning('All  notifications deleted');
        return redirect()->route('system.notification.index');
    }

    public function markAllAsRead() {
        $this->notification->markAllAsReadForUser($this->auth->check()->id);
        flash()->success('All notifications marked as read');
        return redirect()->route('system.notification.index');
    }

}
