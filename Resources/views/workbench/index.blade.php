@extends('layouts.app')

@section('content_title','Workbench')
@section('content_description','Coffee workbench')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1-1" data-toggle="tab">Generators</a></li>
                <li><a href="#tab_2-2" data-toggle="tab">Migrations</a></li>
                <li><a href="#tab_3-3" data-toggle="tab">Seed</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1-1">
                    @include('core::workbench.tabs.generate')
                </div>
                <div class="tab-pane" id="tab_2-2">
                    @include('core::workbench.tabs.migrate')
                </div>
                <div class="tab-pane" id="tab_3-3">
                    @include('core::workbench.tabs.seed')
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script>
    $(document).ready(function () {
        $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        });
    });
</script>
@stop
