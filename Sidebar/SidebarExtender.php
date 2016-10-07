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
                $item->route('system.dashboard');
            });
            $group->item('Sudo', function (Item $item) {
                $item->icon('fa fa-code');

                $item->item('Modules', function (Item $item) {
                    $item->icon('fa fa-puzzle-piece');
                    $item->weight(100);
                    $item->route('system.modules.index');
                    $item->authorize(true);
                });
                $item->item('Themes', function (Item $item) {
                    $item->icon('fa fa-desktop');
                    $item->weight(101);
                    $item->route('system.themes.index');
                    $item->authorize(true);
                });
                $item->item('Workbench', function (Item $item) {
                    $item->icon('fa fa-coffee');
                    $item->weight(101);
                    $item->route('system.workbench.index');
                    $item->authorize(true);
                });
            });
        });
        return $menu;
    }

}
