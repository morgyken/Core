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

use Illuminate\Contracts\Container\Container;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\ShouldCache;
use Maatwebsite\Sidebar\Sidebar;
use Maatwebsite\Sidebar\Traits\CacheableTrait;

/**
 * Description of Sidebar
 *
 * @author samueldervis
 */
class AdminSidebar implements Sidebar, ShouldCache
{

    use CacheableTrait;

    /**
     * @var Menu
     */
    protected $menu;

    /**
     * @var Container
     */
    protected $container;

    /**
     * AdminSidebar constructor.
     * @param Menu $menu
     * @param Container $container
     */
    public function __construct(Menu $menu, Container $container)
    {
        $this->menu = $menu;
        $this->container = $container;
    }

    /**
     * Build your sidebar implementation here
     */
    public function build()
    {
        $enabled = \Module::getOrdered();
        foreach ($enabled as $module) {
            $name = studly_case($module->get('name'));
            $class = 'Ignite\\' . $name . '\\Sidebar\\SidebarExtender';
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
    public function getMenu()
    {
        return $this->menu;
    }

}
