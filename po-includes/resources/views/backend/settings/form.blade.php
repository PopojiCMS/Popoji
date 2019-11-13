<div class="form-row">
	<div class="form-group col-md-6">
		{!! Form::label('groups', __('setting.group').' *', ['class' => 'control-label']) !!}
		<select class="select-style form-control" id="groups" name="groups">
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
		@if($setting->options == 'favicon' || $setting->options == 'logo' || $setting->options == 'logo_footer')
			<div class="input-group">
				{!! Form::text('value', null, ['class' => $errors->has('value') ? 'form-control is-invalid' : 'form-control', 'id' => 'input-filemanager', 'required' => 'required']) !!}
				<span class="input-group-append">
					<a href="{{ url('po-content/filemanager/dialog.php?type=1&field_id=input-filemanager&relative_url=1&akey='.env('FM_KEY')) }}" id="filemanager" class="btn btn-secondary"><i class="fa fa-file"></i> {{ __('general.browse') }}</a>
				</span>
			</div>
		@elseif($setting->options == 'maintenance_mode' || $setting->options == 'member_registration' || $setting->options == 'comment')
			<select class="select-style form-control" id="value" name="value">
				@if (isset($setting))
				<option value="{{ $setting->value }}">{{ __('general.selected') }} {{ $setting->value == 'Y' ? 'Yes' : 'No' }}</option>
				@endif
				<option value="Y">Yes</option>
				<option value="N">No</option>
			</select>
		@elseif($setting->options == 'mail_protocol')
			<select class="select-style form-control" id="value" name="value">
				@if (isset($setting))
				<option value="{{ $setting->value }}">{{ __('general.selected') }} {{ $setting->value }}</option>
				@endif
				<option value="SMTP">SMTP</option>
				<option value="Mail">Mail</option>
			</select>
		@elseif($setting->options == 'sitemap_frequency')
			<select class="select-style form-control" id="value" name="value">
				@if (isset($setting))
				<option value="{{ $setting->value }}">{{ __('general.selected') }} {{ $setting->value }}</option>
				@endif
				<option value="daily">daily</option>
				<option value="weekly">weekly</option>
				<option value="monthly">monthly</option>
				<option value="yearly">yearly</option>
			</select>
		@elseif($setting->options == 'slug')
			<select class="select-style form-control" id="value" name="value">
				@if (isset($setting))
				<option value="{{ $setting->value }}">{{ __('general.selected') }} {{ $setting->value }}</option>
				@endif
				<option value="detailpost/slug">detailpost/slug</option>
				<option value="post/slug">post/slug</option>
				<option value="post/slug-id">post/slug-id</option>
				<option value="article/yyyy/mm/dd/slug">article/yyyy/mm/dd/slug</option>
			</select>
		@else
			{!! Form::text('value', null, ['class' => $errors->has('value') ? 'form-control is-invalid' : 'form-control', 'required' => 'required']) !!}
		@endif
	@else
		{!! Form::text('value', null, ['class' => $errors->has('value') ? 'form-control is-invalid' : 'form-control', 'required' => 'required']) !!}
	@endif
    {!! $errors->first('value', '<p class="help-block">:message</p>') !!}
</div>
