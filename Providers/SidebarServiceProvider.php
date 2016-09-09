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

namespace Ignite\Core\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Maatwebsite\Sidebar\SidebarManager;
use Ignite\Core\Library\AdminSidebar;

class SidebarServiceProvider extends ServiceProvider {

    protected $defer = true;
    private $request;

    /**
     * Register the service provider.
     * @return void
     */
    public function register() {

    }

    /**
     * @param SidebarManager $manager
     * @param Request $request
     */
    public function boot(SidebarManager $manager, Request $request) {
        $this->request = $request;
        if ($this->onBackend() === true) {
            $manager->register(AdminSidebar::class);
        }
    }

    /**
     *
     * @return boolean
     */
    private function onBackend() {
        return true; //for my sake please
        $url = $this->request->url();
        if (str_contains($url, mconfig('core.core.admin-prefix'))) {
            return true;
        }
        return false;
    }

}
