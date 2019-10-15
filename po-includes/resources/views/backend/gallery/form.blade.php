<div class="form-row">
	<div class="form-group col-md-6">
		{!! Form::label('album_id', __('gallery.album').' *', ['class' => 'control-label']) !!}
		<select name="album_id" class="select-album form-control" required>
			@foreach($albums as $album)
				<option value="{{ $album->id }}">{{ $album->title }}</option>
			@endforeach
			@if($formMode == 'edit')
				<option value="{{ $gallery->album_id }}" selected>{{ $gallery->album->title }}</option>
			@endif
		</select>
	</div>
	<div class="form-group col-md-6">
		{!! Form::label('title', __('gallery.title').' *', ['class' => 'control-label']) !!}
		{!! Form::text('title', null, ['class' => $errors->has('title') ? 'form-control is-invalid' : 'form-control', 'required' => 'required']) !!}
		{!! $errors->first('title', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group">
	{!! Form::label('picture', __('gallery.picture').' *', ['class' => 'control-label']) !!}
	<div class="input-group">
		{!! Form::text('picture', null, ['class' => $errors->has('picture') ? 'form-control is-invalid' : 'form-control', 'id' => 'input-filemanager', 'required' => 'required']) !!}
		<span class="input-group-append">
			<a href="{{ url('po-content/filemanager/dialog.php?type=1&field_id=input-filemanager&relative_url=1&akey='.env('FM_KEY')) }}" id="filemanager" class="btn btn-secondary"><i class="fa fa-file"></i> {{ __('general.browse') }}</a>
		</span>
	</div>
</div>
<div class="form-group">
	{!! Form::label('content', __('gallery.content'), ['class' => 'control-label']) !!}
	{!! Form::textarea('content', null, ['class' => $errors->has('content') ? 'form-control is-invalid ht-150-i' : 'form-control ht-150-i']) !!}
	{!! $errors->first('content', '<p class="help-block">:message</p>') !!}
</div>
