<div class="form-row">
	<div class="form-group col-md-6">
		{!! Form::label('parent', __('category.parent').' *', ['class' => 'control-label']) !!}
		<select class="select2 form-control" id="parent" name="parent">
			@if($formMode == 'edit')
				@if($category->parent == 0)
					<option value="0">{{ __('general.selected') }} {{ __('category.no_parent') }}</option>
				@else
					<option value="{{ $category->parent }}">{{ __('general.selected') }} {{ $category->mainParent->title }}</option>
				@endif
			@else
				<option value="0">{{ __('category.no_parent') }}</option>
			@endif
			{{ categoryTreeOption($parents) }}
		</select>
		{!! $errors->first('parent', '<p class="help-block">:message</p>') !!}
	</div>
	<div class="form-group col-md-6">
		{!! Form::label('picture', __('category.picture'), ['class' => 'control-label']) !!}
		<div class="input-group">
			{!! Form::text('picture', null, ['class' => $errors->has('picture') ? 'form-control is-invalid' : 'form-control', 'id' => 'input-filemanager']) !!}
			<span class="input-group-append">
				<a href="{{ url('po-content/filemanager/dialog.php?type=1&field_id=input-filemanager&relative_url=1&&akey=i7GLt0sqUVc0uWdlxT4t8TftzX5Ebi8gm8uqa6IGE6w') }}" id="filemanager" class="btn btn-secondary"><i class="fa fa-file"></i> {{ __('general.browse') }}</a>
			</span>
		</div>
	</div>
</div>
<div class="form-group">
	{!! Form::hidden('seotitle', null, ['id' => 'seotitle']) !!}
	{!! Form::label('title', __('category.title').' *', ['class' => 'control-label']) !!}
	{!! Form::text('title', null, ['class' => $errors->has('title') ? 'form-control is-invalid' : 'form-control', 'required' => 'required']) !!}
	{!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
@if($formMode == 'edit')
<div class="form-group">
	{!! Form::label('active', __('category.active').' *', ['class' => 'control-label']) !!}
	<select class="select2 form-control" id="active" name="active">
		<option value="{{ $category->active }}">{{ __('general.selected') }} {{ $category->active }}</option>
		<option value="Y">Y</option>
		<option value="N">N</option>
	</select>
	{!! $errors->first('block', '<p class="help-block">:message</p>') !!}
</div>
@endif
