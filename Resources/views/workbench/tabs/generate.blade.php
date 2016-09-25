<div class="row">
    <div class="col-md-6">
        {!! Form::open(['route' => 'system.workbench.generate', 'method' => 'post']) !!}
        <div class="box-body">
            <h4>Generate new module</h4>
            <div class='form-group{{ $errors->has('name') ? ' has-error' : '' }}'>
                {!! Form::label('name', 'Module name') !!}
                {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Module name']) !!}
                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary btn-flat">Generate new module</button>
        </div>
        {!! Form::close() !!}
    </div>
    <div class="col-md-6">
        {!! Form::open(['route' => 'system.workbench.install', 'method' => 'post']) !!}
        <div class="box-body">
            <h4>Vendor name</h4>
            <div class='form-group{{ $errors->has('vendorName') ? ' has-error' : '' }}'>
                {!! Form::label('vendorName', 'Vendor name') !!}
                {!! Form::text('vendorName', old('vendorName'), ['class' => 'form-control', 'placeholder' => 'Vendor name']) !!}
                {!! $errors->first('vendorName', '<span class="help-block">:message</span>') !!}
            </div>
            <div class="checkbox">
                <label for="subtree">
                    <input id="subtree" name="subtree" type="checkbox" class="flat-blue" value="true" /> Install as subtree
                </label>
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary btn-flat">Install new module</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>
