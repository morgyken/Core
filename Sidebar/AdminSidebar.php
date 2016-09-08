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

namespace Modules\Core\Sidebar;

use Illuminate\Contracts\Container\Container;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\ShouldCache;
use Maatwebsite\Sidebar\Sidebar;
use Maatwebsite\Sidebar\Traits\CacheableTrait;
use Nwidart\Modules\Contracts\RepositoryInterface;

/**
 * Description of AdminSidebar
 *
 * @author samuel
 */
class AdminSidebar implements Sidebar, ShouldCache {

    use CacheableTrait;

    /**
     * @var Menu
     */
    protected $menu;

    /**
     * @var RepositoryInterface
     */
    protected $modules;

    /**
     * @var Container
     */
    protected $container;

    /**
     * @param Menu                $menu
     * @param RepositoryInterface $modules
     * @param Container           $container
     */
    public function __construct(Menu $menu, RepositoryInterface $modules, Container $container) {
        $this->menu = $menu;
        $this->modules = $modules;
        $this->container = $container;
    }

    /**
     * Build your sidebar implementation here
     */
    public function build() {
        foreach ($this->modules->enabled() as $module) {
            $name = studly_case($module->get('name'));
            $class = 'Modules\\' . $name . '\\Sidebar\\SidebarExtender';

            if (class_exists($class)) {
                $extender = $this->container->make($class);

                $this->menu->add(
                        $extender->extendWith($this->menu)
                );
            }
        }
    }

    /**
     * @return Menu
     */
    public function getMenu() {
        return $this->menu;
    }

}
