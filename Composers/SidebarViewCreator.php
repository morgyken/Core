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

namespace Modules\Core\Composers;

use Maatwebsite\Sidebar\Presentation\SidebarRenderer;
use Modules\Core\Library\AdminSidebar;

/**
 * Description of SidebarViewCreator
 *
 * @author samueldervis
 */
class SidebarViewCreator {

    /**
     * @var AdminSidebar
     */
    protected $sidebar;

    /**
     * @var SidebarRenderer
     */
    protected $renderer;

    /**
     * @param AdminSidebar    $sidebar
     * @param SidebarRenderer $renderer
     */
    public function __construct(AdminSidebar $sidebar, SidebarRenderer $renderer) {
        $this->sidebar = $sidebar;
        $this->renderer = $renderer;
    }

    public function create($view) {
        $view->sidebar = $this->renderer->render($this->sidebar);
    }

}
