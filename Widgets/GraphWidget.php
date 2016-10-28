<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Ignite\Core\Widgets;

use Ignite\Core\Library\BaseDashboardWidgets;

/**
 * Description of GraphWidget
 *
 * @author samuel
 */
class GraphWidget extends BaseDashboardWidgets {

    private $info = [];

    /**
     * Get the widget name
     * @return string
     */
    protected function name() {
        return 'Graphs';
    }

    /**
     * Return an array of widget options
     * Possible options:
     *  x, y, width, height
     * @return array
     */
    protected function options() {
        return [
            'width' => '12',
            'height' => '2',
            'x' => '2',
        ];
    }

    /**
     * Get the widget view
     * @return string
     */
    protected function view() {
        return 'core::widgets.graphs';
    }

    /**
     * Get the widget data to send to the view
     * @return array
     */
    protected function data() {
        return ['data' => $this->info];
    }

}
