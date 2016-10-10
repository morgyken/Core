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
?>
@extends('layouts.app')

@section('content_title','Dashboard')
@section('content_description','Quick glance at system')

@section('styles')
<style>
    .grid-stack-item {
        padding-right: 20px !important;
    }
</style>
@stop

@section('content')
<!--
<div class="row">
    <div class="btn-group pull-right">
        <a class="btn btn-default" id="edit-grid" data-mode="0" href="#"> Edit</a>
        <a class="btn btn-default" id="reset-grid" href="{{ route('system.dashboard.grid.reset')  }}">Reset</a>
        <a class="btn btn-default hidden" id="add-widget" data-toggle="modal" data-target="#myModal">Add Widget</a>
    </div>
    <div class="clearfix"></div>
</div>
-->
<div class="row">
    <div class="col-md-12">
        <div class="grid-stack">
        </div>
    </div>
</div>
<div class="clearfix"></div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add widget to dashboard</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
@parent
<script type="text/javascript">
    $(document).ready(function () {
    //size function for gridstack
    $.fn.size = function(){
    return this.length;
    };
    var options = {
    vertical_margin: 10,
            float: true,
            animate: true
    };
    $('.grid-stack').gridstack(options);
    /** savey crap */
    new function () {
    this.defaultWidgets = {!! json_encode($widgets) !!};
    this.serialized_data = {!! $customWidgets !== 'null' ? $customWidgets : json_encode($widgets) !!};
    this.grid = jQuery('.grid-stack').data('gridstack');
    this.load_grid = function () {
    this.grid.remove_all();
    var items = GridStackUI.Utils.sort(this.serialized_data);
    _.each(items, function (node) {
    this.spawn_widget(node);
    jQuery(jQuery.find('option[value="' + node.id + '"]')[0]).hide();
    }, this);
    }.bind(this);
    this.save_grid = function () {
    this.serialized_data = _.map($('.grid-stack > .grid-stack-item:visible'), function (el) {
    el = jQuery(el);
    var node = el.data('_gridstack_node');
    return {
    id: el.attr('id'),
            x: node.x,
            y: node.y,
            width: node.width,
            height: node.height
    };
    }, this);
    $.ajax({
    type: 'POST',
            url: "{{ route('system.dashboard.grid.save') }}",
            data: {
            _token: '<?= csrf_token() ?>',
                    grid: JSON.stringify(this.serialized_data)
            },
            success: function(data) {
            console.log(data);
            }
    });
    }.bind(this);
    this.clear_grid = function () {
    this.grid.remove_all();
    jQuery(jQuery.find('option:hidden')).show();
    }.bind(this);
    this.edit_grid = function () {
    mode = jQuery('#edit-grid').data('mode');
    if (mode == 0) {
    // enable all the grid editing
    _.map(jQuery('.grid-stack > .grid-stack-item:visible'), function (el) {
    this.grid.movable(el, true);
    jQuery(el).on('dblclick', function (e) {
    this.grid.resizable(el, true);
    }.bind(this));
    }, this);
    jQuery('#edit-grid').data('mode', 1).text('Save grid');
    } else {
    // disable all the grid editing
    _.map(jQuery('.grid-stack > .grid-stack-item:visible'), function (el) {
    this.grid.movable(el, false);
    this.grid.resizable(el, false);
    jQuery(el).off('dblclick');
    }, this);
    jQuery('#edit-grid').data('mode', 0).text('Edit grid');
    // run the save mech
    this.save_grid();
    }
    }.bind(this);
    this.spawn_widget = function (node) {
    var html = node.html === undefined ? this.defaultWidgets[node.id].html : node.html,
            element = jQuery('<div><div class="grid-stack-item-content" />' + html + '<div/>'),
            x = node.options === undefined ? node.x : node.options.x,
            y = node.options === undefined ? node.y : node.options.y,
            width = node.options === undefined ? node.width : node.options.width,
            height = node.options === undefined ? node.height : node.options.height;
    this.grid.add_widget(element, x, y, width, height);
    element.attr({id: node.id});
    this.grid.resizable(element, false);
    this.grid.movable(element, false);
    return element;
    }.bind(this);
    jQuery('#edit-grid').on('click', this.edit_grid);
    jQuery('#myModal').on('hidden.bs.modal', function (e) {
    value = jQuery('select[name=widget]').val();
    if (value == 'x') {
    return;
    }
    element = this.spawn_widget({
    auto_position: true,
            width: 2,
            height: 2,
            id: value
    });
    this.grid.resizable(element, true);
    this.grid.movable(element, true);
    }.bind(this));
    this.load_grid();
    };
    });
</script>
@stop
