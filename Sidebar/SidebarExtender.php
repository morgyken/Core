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

namespace Ignite\Core\Sidebar;

use Ignite\Core\Contracts\Authentication;
use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;

class SidebarExtender implements \Maatwebsite\Sidebar\SidebarExtender {

    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth) {
        $this->auth = $auth;
    }

    /**
     * @param Menu $menu
     *
     * @return Menu
     */
    public function extendWith(Menu $menu) {
        $menu->group('Dashboard', function (Group $group) {
            $group->item('Dashboard', function (Item $item) {
                $item->icon('fa fa-dashboard');
                $item->route('dashboard');
                //$item->isActiveWhen(route('dashboard.index', null, false));
            });
        });
        return $menu;
    }

}
