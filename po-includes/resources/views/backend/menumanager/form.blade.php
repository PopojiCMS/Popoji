<div class="form-group">
	{!! Form::label('title', __('menumanager.title').' *', ['class' => 'control-label']) !!}
	{!! Form::text('title', null, ['class' => $errors->has('title') ? 'form-control is-invalid' : 'form-control', 'required' => 'required']) !!}
	{!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
	{!! Form::label('url', __('menumanager.url').' *', ['class' => 'control-label']) !!}
	{!! Form::text('url', null, ['class' => $errors->has('url') ? 'form-control is-invalid' : 'form-control', 'required' => 'required']) !!}
	{!! $errors->first('url', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
	{!! Form::label('class', __('menumanager.class'), ['class' => 'control-label']) !!}
	{!! Form::text('class', null, ['class' => $errors->has('class') ? 'form-control is-invalid' : 'form-control']) !!}
	{!! $errors->first('class', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
	{!! Form::label('target', __('menumanager.target').' *', ['class' => 'control-label']) !!}
	<select class="form-control select-style" id="target" name="target">
		<option value="none">none</option>
		<option value="_blank">_blank</option>
	</select>
	{!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
