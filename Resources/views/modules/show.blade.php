<?php
$module = $data['module'];
$changelog = $data['changelog'];
$status = $module->enabled() ? 'disable' : 'enable';
$routeName = $module->enabled() ? 'disable' : 'enable';
?>
@extends('layouts.app')

@section('content_header','Manage module')
@section('content_description','Manage this module')

@section('styles')
<style>
    .module-type {
        text-align: center;
    }
    .module-type span {
        display: block;
    }
    .module-type i {
        font-size: 124px;
    }
    form {
        display: inline;
    }
</style>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool jsPublishAssets" data-toggle="tooltip"
                            title="" data-original-title="{{ trans("workshop::modules.publish assets") }}">
                        <i class="fa fa-cloud-upload"></i> Publish Assets
                    </button>
                    <?php ?>
                    {!! Form::open(['route' => ["system.modules.$routeName", $module->getName()], 'method' => 'post']) !!}
                    <button class="btn btn-box-tool" data-toggle="tooltip" type="submit"
                            title="" data-original-title="{{$status}}">
                        <i class="fa fa-toggle-{{ $module->enabled() ? 'on' : 'off' }}"></i>
                        {{ $status }}
                    </button>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12 module-details">
                        <div class="module-type pull-left">
                            <i class="fa fa-cube"></i>
                            <span>{{ $module->version }}</span>
                        </div>
                        <h2>{{ ucfirst($module->getName()) }}</h2>
                        <p>{{ $module->getDescription() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if (!empty($changelog) && count($changelog['versions'])): ?>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-bars"></i> {{ trans('workshop::modules.changelog')}}</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    @include('core::modules.partials.changelog')
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
@stop

@section('scripts')
<script>
    $(document).ready(function () {
        $('.jsPublishAssets').on('click', function (event) {
            event.preventDefault();
            var $self = $(this);
            $self.find('i').toggleClass('fa-cloud-upload fa-refresh fa-spin');
            $.ajax({
                type: 'POST',
                url: '{{ route('api.core.module.publish', [$module->getName()]) }}',
                data: {_token: '{{ csrf_token() }}'},
                success: function () {
                    $self.find('i').toggleClass('fa-cloud-upload fa-refresh fa-spin');
                }
            });
        });
    });
</script>
@stop
