@extends('layouts.app')

@section('content_title','System themes')

@section('styles')
<style>
    .jsUpdateModule {
        transition: all .5s ease-in-out;
    }
</style>
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="data-table table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th width="15%">Type</th>
                            <th width="15%">Version</th>
                            <th width="15%">Enabled</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['themes'] as $theme)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $theme->getName() }}</td>
                            <td>{{ $theme->type }}</td>
                            <td>{{ $theme->version }}</td>
                            <td>
                                <span class="label label-{{$theme->active ? 'success' : 'danger'}}">
                                    {{ $theme->active ? 'Enabled' : 'Disabled' }}
                                </span>
                            </td>
                            <td><a href="{{ route('system.themes.show', [$theme->getName()]) }}"
                                   class="btn btn-xs btn-primary">
                                    <i class="fa fa-wrench"></i> Manage</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</div>
@stop

@section('scripts')
<script>
    $(function () {
        $('.data-table').dataTable({
            "paginate": true,
            "lengthChange": true,
            "filter": true,
            "sort": true,
            "info": true,
            "autoWidth": true,
            "order": [[0, "asc"]],
            "columns": [
                null,
                null,
                null
            ]
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        });
        $('.jsUpdateModule').on('click', function (e) {
            $(this).data('loading-text', '<i class="fa fa-spinner fa-spin"></i> Loading ...');
            var $btn = $(this).button('loading');
            var token = '<?= csrf_token() ?>';
            $.ajax({
                type: 'POST',
                url: "{{route('system.modules.update')}}",
                data: {module: $btn.data('module'), _token: token},
                success: function (data) {
                    console.log(data);
                    if (data.updated) {
                        $btn.button('reset');
                        $btn.removeClass('btn-primary');
                        $btn.addClass('btn-success');
                        $btn.html('<i class="fa fa-check"></i> Module updated!')
                        setTimeout(function () {
                            $btn.removeClass('btn-success');
                            $btn.addClass('btn-primary');
                            $btn.html('Update');
                        }, 2000);
                    }
                }
            });
        });
    });
</script>
@stop
