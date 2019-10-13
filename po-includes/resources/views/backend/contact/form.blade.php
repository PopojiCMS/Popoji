<div class="form-row">
	<div class="form-group col-md-4">
		{!! Form::label('name', __('contact.name').' *', ['class' => 'control-label']) !!}
		{!! Form::text('name', null, ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control', 'required' => 'required']) !!}
		{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
	</div>
	<div class="form-group col-md-4">
		{!! Form::label('email', __('contact.email').' *', ['class' => 'control-label']) !!}
		{!! Form::text('email', null, ['class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control', 'required' => 'required']) !!}
		{!! $errors->first('email', '<p class="help-block">:message</p>') !!}
	</div>
	<div class="form-group col-md-4">
		{!! Form::label('subject', __('contact.subject').' *', ['class' => 'control-label']) !!}
		{!! Form::text('subject', null, ['class' => $errors->has('subject') ? 'form-control is-invalid' : 'form-control', 'required' => 'required']) !!}
		{!! $errors->first('subject', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group">
	{!! Form::label('message', __('contact.message').' *', ['class' => 'control-label']) !!}
	{!! Form::textarea('message', null, ['class' => $errors->has('message') ? 'form-control is-invalid ht-150-i' : 'form-control ht-150-i', 'required' => 'required']) !!}
	{!! $errors->first('message', '<p class="help-block">:message</p>') !!}
</div>
@if($formMode == 'edit')
<div class="form-group">
	{!! Form::label('status', __('contact.status').' *', ['class' => 'control-label']) !!}
	<select class="select-style form-control" id="status" name="status">
		<option value="{{ $contact->status }}">{{ __('general.selected') }} {{ $contact->status == 'Y' ? __('contact.read') : __('contact.unread') }}</option>
		<option value="Y">{{ __('contact.read') }}</option>
		<option value="N">{{ __('contact.unread') }}</option>
	</select>
	{!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>
@endif
