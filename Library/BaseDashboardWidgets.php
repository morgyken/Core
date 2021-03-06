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

use Ignite\Core\Composers\DashboardWidgetViewComposer;
use Illuminate\Contracts\View\Factory as ViewFactory;

/**
 * Description of BaseDashboardWidgets
 *
 * @author samuel
 */
abstract class BaseDashboardWidgets {

    /**
     * Boot the widget and add the data to the dashboard view composer
     */
    public function boot() {
        $widgetViewComposer = app(DashboardWidgetViewComposer::class);
        /** @var ViewFactory $view */
        $view = app(ViewFactory::class);

        if ($view->exists($this->view())) {
            $html = $view->make($this->view())
                    ->with($this->data())
                    ->render();

            $sluggedName = str_slug($this->name());

            $widgetViewComposer
                    ->setWidgetName($sluggedName)
                    ->addSubView($sluggedName, $html)
                    ->addWidgetOptions($sluggedName, $this->options());
        }
    }

    /**
     * Get the widget name
     * @return string
     */
    abstract protected function name();

    /**
     * Return an array of widget options
     * Possible options:
     *  x, y, width, height
     * @return array
     */
    abstract protected function options();

    /**
     * Get the widget view
     * @return string
     */
    abstract protected function view();

    /**
     * Get the widget data to send to the view
     * @return array
     */
    abstract protected function data();
}
