@extends('layouts.app')
@section('title', __('post.create_title'))

@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-20">
		<div>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb breadcrumb-style1 mg-b-10">
					<li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ __('general.dashboard') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/posts/table') }}">{{ __('general.content') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/posts/table') }}">{{ __('general.posts') }}</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{ __('post.create_title') }}</li>
				</ol>
			</nav>
			<h4 class="mg-b-0 tx-spacing--1">{{ __('post.create_title') }}</h4>
		</div>
		
		<div><a href="{{ url('dashboard/posts/table') }}" class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-t-10"><i data-feather="arrow-left" class="wd-10 mg-r-5"></i> {{ __('general.back') }}</a></div>
	</div>
	
	<div class="card">
		{!! Form::open(['url' => '/dashboard/posts', 'class' => 'form-horizontal']) !!}
			<div class="card-body pd-b-0">
				@if ($errors->any())
					<ul class="alert alert-danger">
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				@endif
				
				@include ('backend.post.form', ['formMode' => 'create'])
			</div>
			<div class="card-footer">
				<button type="submit" class="btn btn-primary"><i data-feather="send" class="wd-10 mg-r-5"></i> {{ __('general.create') }}</button>
			</div>
		{!! Form::close() !!}
	</div>
@endsection

@push('styles')
<link href="{{ asset('po-admin/lib/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{ asset('po-admin/lib/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script src="{{ asset('po-admin/lib/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('po-admin/lib/typeahead.js/typeahead.bundle.min.js') }}"></script>

<script type="text/javascript">
	tinymce.init({
		selector: "#content",
		height: 600,
		min_height: 600,
		plugins: [
			"advlist autolink link image lists charmap print preview hr anchor pagebreak",
			"searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
			"table directionality emoticons paste",
			"save code fullscreen autoresize codesample autosave responsivefilemanager"
		],
		menubar : false,
		toolbar1: "undo redo restoredraft | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist hr | outdent indent table searchreplace",
		toolbar2: "| fontsizeselect | styleselect | link unlink anchor | image media emoticons | forecolor backcolor | code codesample fullscreen ",
		contextmenu: "link paste image imagetools table spellchecker",
		image_advtab: true,
		fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
		relative_urls: false,
		remove_script_host: false,
		external_filemanager_path: "{{ url('po-content/filemanager') }}/",
		filemanager_title: "{{ __('general.filemanager') }}",
		external_plugins: {
			"filemanager" : "{{ asset('po-content/filemanager/plugin.min.js') }}"
		},
		filemanager_access_key: '{{ env("FM_KEY") }}',
	});
	
	$(function() {
		var tagname = new Bloodhound({
			datumTokenizer: Bloodhound.tokenizers.obj.whitespace('title'),
			queryTokenizer: Bloodhound.tokenizers.whitespace,
			remote: {
				url: '{{ url("dashboard/tags/get-tag") }}',
				prepare: function (query, settings) {
					$(".tt-hint").show();
					settings.type = "GET";
					settings.data = 'term=' + query;
					return settings;
				},
				filter: function (parsedResponse) {
					$(".tt-hint").hide();
					return parsedResponse.data;
				}
			}
		});
		
		tagname.initialize();
		
		$('#tag').tagsinput({
			typeaheadjs: {
				name: 'tagname',
				displayKey: 'title',
				valueKey: 'title',
				source: tagname.ttAdapter()
			}
		});
	});
</script>
@endpush
