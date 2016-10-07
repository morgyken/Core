<?php

namespace Ignite\Core\Http\Controllers;

use Ignite\Core\Contracts\Authentication;
use Ignite\Core\Repositories\WidgetRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DashboardController extends AdminBaseController {

    /**
     * @var WidgetRepository
     */
    private $widget;

    /**
     * @var Authentication
     */
    private $auth;

    /**
     * @param Repository $modules
     * @param WidgetRepository $widget
     * @param Authentication $auth
     */
    public function __construct(WidgetRepository $widget, Authentication $auth) {
        parent::__construct();
        $this->bootWidgets();
        $this->widget = $widget;
        $this->auth = $auth;
    }

    /**
     * Display the dashboard with its widgets
     * @return \Illuminate\View\View
     */
    public function index() {
        $this->requireAssets();
        $widget = $this->widget->findForUser($this->auth->check()->id);
        $customWidgets = json_encode(null);
        if ($widget) {
            $customWidgets = $widget->widgets;
        }
        return view('dashboard::dashboard', compact('customWidgets'));
    }

    /**
     * Save the current state of the widgets
     * @param Request $request
     * @return mixed
     */
    public function save(Request $request) {
        $widgets = $request->get('grid');

        if (empty($widgets)) {
            return Response::json([false]);
        }

        $this->widget->updateOrCreateForUser($widgets, $this->auth->check()->id);

        return Response::json([true]);
    }

    /**
     * Reset the grid for the current user
     */
    public function reset() {
        $widget = $this->widget->findForUser($this->auth->check()->id);

        if (!$widget) {
            flash()->warning('Dashboard reset not needed');
            return redirect()->route('system.dashboard');
        }
        $this->widget->destroy($widget);
        flash('Dashboard has been reset', 'success');
        return redirect()->route('system.dashboard');
    }

    /**
     * Boot widgets for all enabled modules
     * @param Repository $modules
     */
    private function bootWidgets() {
        $modules = \Module::enabled();
        foreach ($modules as $module) {
            if (!$module->widgets) {
                continue;
            }
            foreach ($module->widgets as $widgetClass) {
                app($widgetClass)->boot();
            }
        }
    }

    /**
     * Require necessary assets
     */
    private function requireAssets() {
        $this->assetPipeline->requireJs('lodash.js');
        /* $this->assetPipeline->requireJs('jquery-ui-core.js');
          $this->assetPipeline->requireJs('jquery-ui-widget.js');
          $this->assetPipeline->requireJs('jquery-ui-mouse.js');
          $this->assetPipeline->requireJs('jquery-ui-draggable.js');
          $this->assetPipeline->requireJs('jquery-ui-resizable.js'); */
        $this->assetPipeline->requireJs('gridstack.js');
        $this->assetPipeline->requireJs('chart.js');
        $this->assetPipeline->requireCss('gridstack.css')->before('asgard.css');
    }

}
