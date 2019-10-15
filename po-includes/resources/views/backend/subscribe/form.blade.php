<div class="form-row">
	<div class="form-group col-md-6">
		{!! Form::label('name', __('subscribe.name').' *', ['class' => 'control-label']) !!}
		{!! Form::text('name', null, ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control', 'required' => 'required']) !!}
		{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
	</div>
	<div class="form-group col-md-6">
		{!! Form::label('email', __('subscribe.email').' *', ['class' => 'control-label']) !!}
		{!! Form::text('email', null, ['class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control', 'required' => 'required']) !!}
		{!! $errors->first('email', '<p class="help-block">:message</p>') !!}
	</div>
</div>
@if($formMode == 'edit')
<div class="form-group">
	{!! Form::label('follow', __('subscribe.follow').' *', ['class' => 'control-label']) !!}
	<select class="select-style form-control" id="follow" name="follow">
		<option value="{{ $subscribe->follow }}">{{ __('general.selected') }} {{ $subscribe->follow == 'Y' ? __('subscribe.follow') : __('subscribe.unfollow') }}</option>
		<option value="Y">{{ __('subscribe.follow') }}</option>
		<option value="N">{{ __('subscribe.unfollow') }}</option>
	</select>
	{!! $errors->first('follow', '<p class="help-block">:message</p>') !!}
</div>
@endif
