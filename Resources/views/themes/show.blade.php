<?php
$theme = $data['theme'];
?>
@extends('layouts.app')

@section('content_title','Manage Theme')
@section('content_description','Manage the '.$theme->getName().' theme' )

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
        margin-right: 20px;
    }
    .module-type span {
        margin-left: -20px;
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
                            title="" data-original-title="Publish assets">
                        <i class="fa fa-cloud-upload"></i> Publish assets
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6 module-details">
                        <div class="module-type pull-left">
                            <i class="fa fa-picture-o"></i>
                            <span>
                                {{ $theme->version }}
                            </span>
                        </div>
                        <h2>{{ ucfirst($theme->getName()) }}</h2>
                        <p>{{ $theme->getDescription() }}</p>
                    </div>
                    <div class="col-sm-6">
                        <dl class="dl-horizontal">
                            <dt>Type:</dt>
                            <dd>{{ $theme->type }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if (!empty($theme->changelog) && count($theme->changelog['versions'])): ?>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-bars"></i> Changelog</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    @include('core::modules.partials.changelog', [
                    'changelog' => $theme->changelog
                    ])
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-info"></i> Theme Information</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt>Name:</dt><dd>{{ $theme->getName() }}</dd>
                        <dt>Description:</dt><dd>{{$theme->getDescription()}}</dd>
                        <dt>Author:</dt><dd>{{$theme->author->name}}</dd>
                        <dt>Email:</dt><dd><small><code>{{$theme->author->email}}</code></small></dd>
                        <dt>Version</dt><dd>{{ str_replace('v', '', $theme->version) }}</dd>
                        <dt>Status</dt><dd>
                            <span class="label label-{{$theme->active ? 'success' : 'danger'}}">
                                {{ $theme->active ?'Enabled' : 'Disabled'}}
                            </span>
                        </dd>
                    </dl>
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
                url: "{{ route('api.core.theme.publish', [$theme->getName()]) }}",
                data: {_token: '{{ csrf_token() }}'},
                success: function () {
                    $self.find('i').toggleClass('fa-cloud-upload fa-refresh fa-spin');
                }
            });
        });
    });
</script>
@stop
