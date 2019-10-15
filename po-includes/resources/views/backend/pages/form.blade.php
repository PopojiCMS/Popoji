<div class="form-row">
	<div class="form-group col-md-6">
		{!! Form::label('title', __('pages.title').' *', ['class' => 'control-label']) !!}
		{!! Form::text('title', null, ['class' => $errors->has('title') ? 'form-control is-invalid' : 'form-control', 'required' => 'required']) !!}
		{!! $errors->first('title', '<p class="help-block">:message</p>') !!}
	</div>
	<div class="form-group col-md-6">
		{!! Form::label('seotitle', __('pages.seotitle').' *', ['class' => 'control-label']) !!}
		{!! Form::text('seotitle', null, ['class' => $errors->has('seotitle') ? 'form-control is-invalid' : 'form-control', 'required' => 'required']) !!}
		{!! $errors->first('seotitle', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group">
	{!! Form::label('content', __('pages.content'), ['class' => 'control-label']) !!}
	{!! Form::textarea('content', null, ['class' => $errors->has('content') ? 'form-control is-invalid ht-300-i' : 'form-control ht-300-i']) !!}
	{!! $errors->first('content', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
	{!! Form::label('picture', __('pages.picture'), ['class' => 'control-label']) !!}
	<div class="input-group">
		{!! Form::text('picture', null, ['class' => $errors->has('picture') ? 'form-control is-invalid' : 'form-control', 'id' => 'input-filemanager']) !!}
		<span class="input-group-append">
			<a href="{{ url('po-content/filemanager/dialog.php?type=1&field_id=input-filemanager&relative_url=1&akey='.env('FM_KEY')) }}" id="filemanager" class="btn btn-secondary"><i class="fa fa-file"></i> {{ __('general.browse') }}</a>
		</span>
	</div>
</div>
@if($formMode == 'edit')
<div class="form-group">
	{!! Form::label('active', __('pages.active').' *', ['class' => 'control-label']) !!}
	<select class="select-style form-control" id="active" name="active">
		<option value="{{ $pages->active }}">{{ __('general.selected') }} {{ $pages->active == 'Y' ? __('pages.active') : __('pages.deactive') }}</option>
		<option value="Y">{{ __('pages.active') }}</option>
		<option value="N">{{ __('pages.deactive') }}</option>
	</select>
	{!! $errors->first('active', '<p class="help-block">:message</p>') !!}
</div>
@endif
