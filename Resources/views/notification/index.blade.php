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

@section('content_title','Notifications')
@section('content_description','View Notifications')


@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                <a href="{{ route('system.notification.mark-all-read') }}" class="btn btn-primary">Mark all as read</a>
                <a href="#" class="btn btn-danger"  data-toggle="modal" data-target="#confirmation-delete-all">Delete All</a>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if(!$notifications->isEmpty())
                <table class="data-table table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Title</th>
                            <th>Message</th>
                            <th>Read</th>
                            <th width="10%" data-sortable="false">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notifications as $notification)
                        <tr>
                            <td>
                                <a href="{{ $notification->link }}">
                                    {{ $notification->time_ago }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ $notification->link }}">
                                    {{ $notification->title }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ $notification->link }}">
                                    {{ $notification->message }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ $notification->link }}">
                                    {{ $notification->is_read ? 'Read' : 'Un read' }}
                                </a>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('notification.delete', [$notification->id]) }}"><i class="fa fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
                @else
                <p>No notifications for you</p>
                @endif
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</div>
@include('core::partials.delete-modal')
<div class="modal fade modal-danger" id="confirmation-delete-all" tabindex="-1" role="dialog" aria-labelledby="deleteAll" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete all my notifications</h4>
            </div>
            <div class="modal-body">
                Are you sure to delete all notifications.<br/>
                You wont get them back anytime.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline btn-flat" data-dismiss="modal">Wait, No!</button>
                {!! Form::open(['route' => ['system.notification.delete-all'], 'method' => 'delete', 'class' => 'pull-left']) !!}
                <button type="submit" class="btn btn-outline btn-flat"><i class="glyphicon glyphicon-trash"></i> Yes, Delete</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop

@section('footer')
<a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
<dl class="dl-horizontal">
    <dt><code>r</code></dt>
    <dd>Mark all as read</dd>
    <dt><code>d + a</code></dt>
    <dd>Delete all</dd>
</dl>
@stop

@section('scripts')
<script type="text/javascript">
    $(function () {
        $('.data-table').dataTable({
            "paginate": true,
            "lengthChange": true,
            "filter": true,
            "sort": true,
            "info": true,
            "autoWidth": true,
            "ordering": true
        });
    });
</script>
@stop
