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
    public function disable(Module $module) {
        if ($this->isCoreModule($module)) {
            return redirect()->route('admin.workshop.modules.show', [$module->getLowerName()])
                            ->with('error', trans('core::modules.module cannot be disabled'));
        }

        $module->disable();

        return redirect()->route('admin.workshop.modules.show', [$module->getLowerName()])
                        ->with('success', trans('core::modules.module disabled'));
    }

    /**
     * Enable the given module
     * @param Module $module
     * @return mixed
     */
    public function enable(Module $module) {
        $module->enable();

        return redirect()->route('admin.workshop.modules.show', [$module->getLowerName()])->with('success', trans('core::modules.module enabled'));
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
    private function isCoreModule(Module $module) {
        $coreModules = array_flip(config('asgard.core.config.CoreModules'));
        return isset($coreModules[$module->getLowerName()]);
    }

}
