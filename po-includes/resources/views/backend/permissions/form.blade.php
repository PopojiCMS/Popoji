<div class="form-group">
    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control', 'required' => 'required']) !!}
	@if($formMode != 'edit')
	<small class="form-text text-muted">Enter 1 module name and then system can create 4 permissions CRUD for you!</small>
	@endif
	{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
