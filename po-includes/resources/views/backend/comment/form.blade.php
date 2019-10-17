<div class="form-row">
	<div class="form-group col-md-6">
		{!! Form::hidden('parent', null) !!}
		{!! Form::hidden('post_id', null) !!}
		{!! Form::label('name', __('comment.name').' *', ['class' => 'control-label']) !!}
		{!! Form::text('name', null, ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control', 'required' => 'required']) !!}
		{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
	</div>
	<div class="form-group col-md-6">
		{!! Form::label('email', __('comment.email').' *', ['class' => 'control-label']) !!}
		{!! Form::text('email', null, ['class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control', 'required' => 'required']) !!}
		{!! $errors->first('email', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group">
	{!! Form::label('content', __('comment.content').' *', ['class' => 'control-label']) !!}
	{!! Form::textarea('content', null, ['class' => $errors->has('content') ? 'form-control is-invalid ht-150-i' : 'form-control ht-150-i', 'required' => 'required']) !!}
	{!! $errors->first('content', '<p class="help-block">:message</p>') !!}
</div>
@if($formMode == 'edit')
<div class="form-row">
	<div class="form-group col-md-6">
		{!! Form::label('active', __('comment.active').' *', ['class' => 'control-label']) !!}
		<select class="select-style form-control" id="active" name="active">
			<option value="{{ $comment->active }}">{{ __('general.selected') }} {{ $comment->active == 'Y' ? __('comment.publish') : __('comment.unpublish') }}</option>
			<option value="Y">{{ __('comment.publish') }}</option>
			<option value="N">{{ __('comment.unpublish') }}</option>
		</select>
		{!! $errors->first('active', '<p class="help-block">:message</p>') !!}
	</div>
	<div class="form-group col-md-6">
		{!! Form::label('status', __('comment.status').' *', ['class' => 'control-label']) !!}
		<select class="select-style form-control" id="status" name="status">
			<option value="{{ $comment->status }}">{{ __('general.selected') }} {{ $comment->status == 'Y' ? __('comment.read') : __('comment.unread') }}</option>
			<option value="Y">{{ __('comment.read') }}</option>
			<option value="N">{{ __('comment.unread') }}</option>
		</select>
		{!! $errors->first('status', '<p class="help-block">:message</p>') !!}
	</div>
</div>
@endif
