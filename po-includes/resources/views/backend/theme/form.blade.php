<div class="form-group">
	{!! Form::label('title', __('theme.title').' *', ['class' => 'control-label']) !!}
	{!! Form::text('title', null, ['class' => $errors->has('title') ? 'form-control is-invalid' : 'form-control', 'required' => 'required']) !!}
	{!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-row">
	<div class="form-group col-md-6">
		{!! Form::label('author', __('theme.author').' *', ['class' => 'control-label']) !!}
		{!! Form::text('author', null, ['class' => $errors->has('author') ? 'form-control is-invalid' : 'form-control', 'required' => 'required']) !!}
		{!! $errors->first('author', '<p class="help-block">:message</p>') !!}
	</div>
	<div class="form-group col-md-6">
		{!! Form::label('folder', __('theme.folder').' *', ['class' => 'control-label']) !!}
		{!! Form::text('folder', null, ['class' => $errors->has('folder') ? 'form-control is-invalid' : 'form-control', 'required' => 'required']) !!}
		{!! $errors->first('folder', '<p class="help-block">:message</p>') !!}
	</div>
</div>
@if($formMode == 'edit')
<div class="form-group">
	{!! Form::label('active', __('theme.active').' *', ['class' => 'control-label']) !!}
	<select class="select-style form-control" id="active" name="active">
		<option value="{{ $theme->active }}">{{ __('general.selected') }} {{ $theme->active == 'Y' ? __('theme.active') : __('theme.deactive') }}</option>
		<option value="Y">{{ __('theme.active') }}</option>
		<option value="N">{{ __('theme.deactive') }}</option>
	</select>
	{!! $errors->first('active', '<p class="help-block">:message</p>') !!}
</div>
@endif
