<div class="row">
	<div class="col-md-9">
		<div class="form-group">
			{!! Form::label('title', __('post.title').' *', ['class' => 'control-label']) !!}
			{!! Form::text('title', null, ['class' => $errors->has('title') ? 'form-control is-invalid' : 'form-control', 'required' => 'required']) !!}
			{!! $errors->first('title', '<p class="help-block">:message</p>') !!}
		</div>
		<div class="form-group">
			{!! Form::label('content', __('post.content'), ['class' => 'control-label']) !!}
			{!! Form::textarea('content', null, ['class' => $errors->has('content') ? 'form-control is-invalid ht-300-i' : 'form-control ht-300-i']) !!}
			{!! $errors->first('content', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			{!! Form::label('seotitle', __('post.seotitle').' *', ['class' => 'control-label']) !!}
			{!! Form::text('seotitle', null, ['class' => $errors->has('seotitle') ? 'form-control is-invalid' : 'form-control', 'required' => 'required']) !!}
			{!! $errors->first('seotitle', '<p class="help-block">:message</p>') !!}
		</div>
		<div class="form-group">
			{!! Form::label('category_id', __('post.category').' *', ['class' => 'control-label']) !!}
			<select class="select-style form-control" id="category_id" name="category_id">
				@if($formMode == 'edit')
					<option value="{{ $post->category_id }}">{{ __('general.selected') }} {{ $post->category->title }}</option>
				@endif
				{{ categoryTreeOption($categorys) }}
			</select>
			{!! $errors->first('parent', '<p class="help-block">:message</p>') !!}
		</div>
		<div class="form-group">
			{!! Form::label('meta_description', __('post.meta_description'), ['class' => 'control-label']) !!}
			{!! Form::textarea('meta_description', null, ['class' => $errors->has('meta_description') ? 'form-control is-invalid ht-100-i' : 'form-control ht-100-i']) !!}
			{!! $errors->first('meta_description', '<p class="help-block">:message</p>') !!}
		</div>
		<div class="form-group">
			{!! Form::label('tag', __('post.tag'), ['class' => 'control-label']) !!}
			{!! Form::text('tag', null, ['class' => $errors->has('tag') ? 'form-control is-invalid' : 'form-control']) !!}
			{!! $errors->first('tag', '<p class="help-block">:message</p>') !!}
		</div>
		<div class="form-row">
			<div class="form-group col-md-6">
				{!! Form::label('type', __('post.type').' *', ['class' => 'control-label']) !!}
				<select class="select-style form-control" id="type" name="type">
					@if($formMode == 'edit')
						<option value="{{ $post->type }}">{{ __('general.selected') }} {{ ucfirst($post->type) }}</option>
					@endif
					<option value="general">General</option>
					<option value="pagination">Pagination</option>
					<option value="picture">Picture</option>
					<option value="video">Video</option>
				</select>
				{!! $errors->first('active', '<p class="help-block">:message</p>') !!}
			</div>
			<div class="form-group col-md-6">
				{!! Form::label('active', __('post.active').' *', ['class' => 'control-label']) !!}
				<select class="select-style form-control" id="active" name="active">
					@if($formMode == 'edit')
						<option value="{{ $post->active }}">{{ __('general.selected') }} {{ $post->active == 'Y' ? __('post.active') : __('post.draft') }}</option>
					@endif
					<option value="Y">{{ __('post.active') }}</option>
					<option value="N">{{ __('post.draft') }}</option>
				</select>
				{!! $errors->first('active', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-6">
				{!! Form::label('headline', __('post.headline').' *', ['class' => 'control-label']) !!}
				<select class="select-style form-control" id="headline" name="headline">
					@if($formMode == 'edit')
						<option value="{{ $post->headline }}">{{ __('general.selected') }} {{ $post->headline == 'Y' ? __('general.yes') : __('general.no') }}</option>
					@endif
					<option value="Y">{{ __('general.yes') }}</option>
					<option value="N">{{ __('general.no') }}</option>
				</select>
				{!! $errors->first('headline', '<p class="help-block">:message</p>') !!}
			</div>
			<div class="form-group col-md-6">
				{!! Form::label('comment', __('post.comment').' *', ['class' => 'control-label']) !!}
				<select class="select-style form-control" id="comment" name="comment">
					@if($formMode == 'edit')
						<option value="{{ $post->comment }}">{{ __('general.selected') }} {{ $post->comment == 'Y' ? __('post.active') : __('post.deactive') }}</option>
					@endif
					<option value="Y">{{ __('post.active') }}</option>
					<option value="N">{{ __('post.deactive') }}</option>
				</select>
				{!! $errors->first('comment', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('picture', __('post.picture'), ['class' => 'control-label']) !!}
			<div class="input-group">
				{!! Form::text('picture', null, ['class' => $errors->has('picture') ? 'form-control is-invalid' : 'form-control', 'id' => 'input-filemanager']) !!}
				<span class="input-group-append">
					<a href="{{ url('po-content/filemanager/dialog.php?type=1&field_id=input-filemanager&relative_url=1&akey='.env('FM_KEY')) }}" id="filemanager" class="btn btn-secondary"><i class="fa fa-file"></i> {{ __('general.browse') }}</a>
				</span>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('picture_description', __('post.picture_description'), ['class' => 'control-label']) !!}
			{!! Form::textarea('picture_description', null, ['class' => $errors->has('picture_description') ? 'form-control is-invalid ht-100-i' : 'form-control ht-100-i']) !!}
			{!! $errors->first('picture_description', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
</div>

@if($formMode == 'edit')
	<div class="row" id="box-gallery">
		@if(count($post_gallerys) > 0)
			<div class="col-md-12 text-center">
				<div class="divider-text">{{ __('post.picture_gallery') }}</div>
			</div>
		@endif
		
		@foreach($post_gallerys as $post_gallery)
			<div class="col-md-4" id="box-item-gallery-{{ Hashids::encode($post_gallery->id) }}">
				<figure class="pos-relative mg-b-10">
					<img src="{{ asset('po-content/uploads/medium/medium_' . $post_gallery->picture) }}" class="img-fit-cover" alt="" />
					<figcaption class="pos-absolute b-0 l-0 wd-100p pd-20">
						<h6 class="tx-white tx-semibold mg-b-20">{{ $post_gallery->title }}</h6>
						<div class="d-flex justify-content-center">
							<div class="btn-group">
								<a href="javascript:void(0);" class="btn btn-dark btn-icon btn-remove-gallery" id="{{ Hashids::encode($post_gallery->id) }}"><i class="fa fa-trash"></i> {{ __('general.delete') }}</a>
							</div>
						</div>
					</figcaption>
				</figure>
			</div>
		@endforeach
	</div>
	
	<div class="row">
		<div class="col-md-12 text-center">
			<div class="divider-text">{{ __('post.add_picture_gallery') }}</div>
		</div>
		<div class="col-md-5">
			<div class="form-group">
				<label for="picture-title">{{ __('post.title') }} *</label>
				<input type="text" class="form-control" id="picture-title" />
			</div>
		</div>
		<div class="col-md-5">
			<div class="form-group">
				<label for="picture-url">{{ __('post.picture') }} *</label>
				<div class="input-group">
					<input type="text" class="form-control" id="picture-url" />
					<span class="input-group-append">
						<a href="{{ url('po-content/filemanager/dialog.php?type=1&field_id=picture-url&relative_url=1&akey='.env('FM_KEY')) }}" id="filemanager-multi" class="btn btn-secondary"><i class="fa fa-file"></i> {{ __('general.browse') }}</a>
					</span>
				</div>
			</div>
		</div>
		<div class="col-md-2">
			<label>&nbsp;</label>
			<a href="javascript:void(0);" class="btn btn-info btn-block btn-add-gallery"><i data-feather="plus" class="wd-10 mg-r-5"></i> {{ __('general.add') }}</a>
		</div>
	</div>
@endif
