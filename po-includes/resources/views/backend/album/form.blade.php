<div class="form-group">
	{!! Form::hidden('seotitle', null, ['id' => 'seotitle']) !!}
	{!! Form::label('title', __('album.title').' *', ['class' => 'control-label']) !!}
	{!! Form::text('title', null, ['class' => $errors->has('title') ? 'form-control is-invalid' : 'form-control', 'required' => 'required']) !!}
	{!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
@if($formMode == 'edit')
<div class="form-group">
	{!! Form::label('active', __('album.active').' *', ['class' => 'control-label']) !!}
	<select class="select-style form-control" id="active" name="active">
		<option value="{{ $album->active }}">{{ __('general.selected') }} {{ $album->active == 'Y' ? __('album.active') : __('album.deactive') }}</option>
		<option value="Y">{{ __('album.active') }}</option>
		<option value="N">{{ __('album.deactive') }}</option>
	</select>
	{!! $errors->first('active', '<p class="help-block">:message</p>') !!}
</div>
@endif
