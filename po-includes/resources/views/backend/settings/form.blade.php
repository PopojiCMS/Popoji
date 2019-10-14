<div class="form-row">
	<div class="form-group col-md-6">
		{!! Form::label('groups', __('setting.group').' *', ['class' => 'control-label']) !!}
		<select class="select2 form-control" id="groups" name="groups">
			@if (isset($setting))
				<option value="{{ $setting->groups }}">{{ __('general.selected') }} {{ $setting->groups }}</option>
			@endif
			<option value="General">General</option>
			<option value="Image">Image</option>
			<option value="Config">Config</option>
			<option value="Mail">Mail</option>
			<option value="Other">Other</option>
		</select>
		{!! $errors->first('groups', '<p class="help-block">:message</p>') !!}
	</div>
	<div class="form-group col-md-6">
		{!! Form::label('options', __('setting.options').' *', ['class' => 'control-label']) !!}
		{!! Form::text('options', null, ['class' => $errors->has('options') ? 'form-control is-invalid' : 'form-control', 'required' => 'required']) !!}
		{!! $errors->first('options', '<p class="help-block">:message</p>') !!}
		<small><i>{{ __('setting.options_info') }}</i></small>
	</div>
</div>
<div class="form-group">
    {!! Form::label('value', __('setting.value').' *', ['class' => 'control-label']) !!}
	@if(isset($setting))
		@if ($setting->options == 'favicon' || $setting->options == 'logo')
			<div class="input-group">
				{!! Form::text('value', null, ['class' => $errors->has('value') ? 'form-control is-invalid' : 'form-control', 'id' => 'input-filemanager', 'required' => 'required']) !!}
				<span class="input-group-append">
					<a href="{{ url('po-content/filemanager/dialog.php?type=1&field_id=input-filemanager&relative_url=1&&akey='.env('FM_KEY')) }}" id="filemanager" class="btn btn-secondary"><i class="fa fa-file"></i> {{ __('general.browse') }}</a>
				</span>
			</div>
		@else
			{!! Form::text('value', null, ['class' => $errors->has('value') ? 'form-control is-invalid' : 'form-control', 'required' => 'required']) !!}
		@endif
	@else
		{!! Form::text('value', null, ['class' => $errors->has('value') ? 'form-control is-invalid' : 'form-control', 'required' => 'required']) !!}
	@endif
    {!! $errors->first('value', '<p class="help-block">:message</p>') !!}
</div>
