<div class="form-group">
    {!! Form::label('name', __('permission.name'), ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control', 'required' => 'required']) !!}
	@if($formMode != 'edit')
	<small class="form-text text-muted">{{ __('permission.name_info') }}</small>
	@endif
	{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
