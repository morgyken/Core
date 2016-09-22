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

namespace Ignite\Core\Http\Controllers;

use Ignite\Core\Library\ModuleManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Response;
use Symfony\Component\Console\Output\BufferedOutput;

class ModulesController extends AdminBaseController {

    /**
     * @var ModuleManager
     */
    private $moduleManager;

    public function __construct(ModuleManager $moduleManager) {
        parent::__construct();
        $this->moduleManager = $moduleManager;
    }

    /**
     * Display a list of all modules
     */
    public function index() {
        $this->data['modules'] = \Module::all();
        return view('core::modules.index', ['data' => $this->data]);
    }

    /**
     * Display module info
     * @param Module $module
     * @return View
     */
    public function show($module) {
        $this->data['module'] = \Module::find($module);
        $this->data['changelog'] = $this->moduleManager->changelogFor($module);
        return view('core::modules.show', ['data' => $this->data]);
    }

    /**
     * Disable the given module
     * @param Module $module
     * @return mixed
     */
    public function disable($mod) {
        $module = \Module::find($mod);
        if ($this->isCoreModule($mod)) {
            flash()->error("Module <strong><u>" . $module->getName()
                    . "</u></strong> is very important. We prevented you from disabling it. Sorry!");
            return redirect()->route('system.modules.show', [$module->getLowerName()]);
        }
        $module->disable();
        flash()->warning("Module <strong><u>" . $module->getName() . "</u></strong> now disabled");
        return redirect()->route('system.modules.show', [$module->getLowerName()]);
    }

    /**
     * Enable the given module
     * @param Module $module
     * @return mixed
     */
    public function enable($mod) {
        $module = \Module::find($mod);
        $module->enable();
        flash()->success("Module <strong><u>" . $module->getName() . "</u></strong> now enabled.");
        return redirect()->route('system.modules.show', [$module->getLowerName()]);
    }

    /**
     * Update a given module
     * @param Request $request
     * @return Response json
     */
    public function update(Request $request) {
        $output = new BufferedOutput();
        Artisan::call('system:module:update', ['module' => $request->get('module')], $output);
        return Response::json(['updated' => true, 'message' => $output->fetch()]);
    }

    /**
     * Check if the given module is a core module that should be be disabled
     * @param Module $module
     * @return bool
     */
    private function isCoreModule($module) {
        $important_modules = mconfig('core.config.core_modules');
        return in_array($module, $important_modules);
    }

}
