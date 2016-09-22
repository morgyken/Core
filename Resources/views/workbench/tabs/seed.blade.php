{!! Form::open(['route' => 'system.workbench.seed', 'method' => 'post']) !!}
<div class="box-body">
    <div class='form-group{{ $errors->has('module') ? ' has-error' : '' }}'>
        {!! Form::label('module','Module Name') !!}
        {!! Form::select('module', $modules, null, ['class' => 'form-control']) !!}
        {!! $errors->first('module', '<span class="help-block">:message</span>') !!}
    </div>
</div>
<div class="box-footer">
    <button type="submit" class="btn btn-primary btn-flat">Seed module</button>
</div>
{!! Form::close() !!}
