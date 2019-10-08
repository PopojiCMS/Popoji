<div class="form-group">
    {!! Form::label('title', __('tag.title').' *', ['class' => 'control-label']) !!}
    {!! Form::text('title', null, ['class' => $errors->has('title') ? 'form-control is-invalid' : 'form-control', 'data-role' => 'tagsinput', 'required' => 'required']) !!}
	<small class="form-text text-muted">{{ __('tag.title_info') }}</small>
	{!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
