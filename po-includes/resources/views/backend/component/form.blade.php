<div class="form-group">
	{!! Form::label('title', __('component.title').' *', ['class' => 'control-label']) !!}
	{!! Form::text('title', null, ['class' => $errors->has('title') ? 'form-control is-invalid' : 'form-control', 'required' => 'required', $formMode == 'edit' ? 'readonly' : '']) !!}
	{!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-row">
	<div class="form-group col-md-4">
		{!! Form::label('author', __('component.author').' *', ['class' => 'control-label']) !!}
		{!! Form::text('author', null, ['class' => $errors->has('author') ? 'form-control is-invalid' : 'form-control', 'required' => 'required', $formMode == 'edit' ? 'readonly' : '']) !!}
		{!! $errors->first('author', '<p class="help-block">:message</p>') !!}
	</div>
	<div class="form-group col-md-4">
		{!! Form::label('folder', __('component.folder').' *', ['class' => 'control-label']) !!}
		{!! Form::text('folder', null, ['class' => $errors->has('folder') ? 'form-control is-invalid' : 'form-control', 'required' => 'required', $formMode == 'edit' ? 'readonly' : '']) !!}
		{!! $errors->first('folder', '<p class="help-block">:message</p>') !!}
	</div>
	<div class="form-group col-md-4">
		{!! Form::label('type', __('component.type').' *', ['class' => 'control-label']) !!}
		<select class="{{ $formMode == 'edit' ? '' : 'select-style' }} form-control" id="type" name="type" {{ $formMode == 'edit' ? 'readonly' : '' }}>
			@if($formMode == 'edit')
				<option value="{{ $component->type }}">{{ __('general.selected') }} {{ $component->type == 'component' ? __('component.type_component') : __('component.type_widget') }}</option>
			@endif
			<option value="component">{{ __('component.type_component') }}</option>
			<option value="type">{{ __('component.type_widget') }}</option>
		</select>
		{!! $errors->first('type', '<p class="help-block">:message</p>') !!}
	</div>
</div>
@if($formMode == 'edit')
<div class="form-group">
	{!! Form::label('active', __('component.active').' *', ['class' => 'control-label']) !!}
	<select class="select-style form-control" id="active" name="active">
		<option value="{{ $component->active }}">{{ __('general.selected') }} {{ $component->active == 'Y' ? __('component.active') : __('component.deactive') }}</option>
		<option value="Y">{{ __('component.active') }}</option>
		<option value="N">{{ __('component.deactive') }}</option>
	</select>
	{!! $errors->first('active', '<p class="help-block">:message</p>') !!}
</div>
@endif
