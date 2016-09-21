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

namespace Ignite\Core\Composers;
use Ignite\Core\Library\ModuleManager;
use Illuminate\Contracts\View\View;

/**
 * Description of MigrateViewComposer
 *
 * @author samuel
 */
class MigrateViewComposer {

    /**
     * @var ModuleManager
     */
    private $module;

    public function __construct(ModuleManager $module) {
        $this->module = $module;
    }

    public function compose(View $view) {
        $view->modules = $this->module->enabled();
    }

}
