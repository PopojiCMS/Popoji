@extends('layouts.app')
@section('title', __('pages.create_title'))

@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-20">
		<div>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb breadcrumb-style1 mg-b-10">
					<li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ __('general.dashboard') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/posts/table') }}">{{ __('general.content') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/pages/table') }}">{{ __('general.pages') }}</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{ __('pages.create_title') }}</li>
				</ol>
			</nav>
			<h4 class="mg-b-0 tx-spacing--1">{{ __('pages.create_title') }}</h4>
		</div>
		
		<div><a href="{{ url('dashboard/pages/table') }}" class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-t-10"><i data-feather="arrow-left" class="wd-10 mg-r-5"></i> {{ __('general.back') }}</a></div>
	</div>
	
	<div class="card">
		{!! Form::open(['url' => '/dashboard/pages', 'class' => 'form-horizontal']) !!}
			<div class="card-body pd-b-0">
				@if ($errors->any())
					<ul class="alert alert-danger">
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				@endif
				
				@include ('backend.pages.form', ['formMode' => 'create'])
			</div>
			<div class="card-footer">
				<button type="submit" class="btn btn-primary"><i data-feather="send" class="wd-10 mg-r-5"></i> {{ __('general.create') }}</button>
			</div>
		{!! Form::close() !!}
	</div>
@endsection

@push('scripts')
<script src="{{ asset('po-admin/lib/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>

<script type="text/javascript">
	tinymce.init({
		selector: "#content",
		height: 300,
		plugins: [
			"advlist autolink link image lists charmap print preview hr anchor pagebreak",
			"searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
			"table contextmenu directionality emoticons paste textcolor",
			"save code fullscreen autoresize codesample autosave responsivefilemanager"
		],
		menubar : false,
		toolbar1: "undo redo restoredraft | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent table searchreplace",
		toolbar2: "| fontsizeselect | styleselect | link unlink anchor | image media emoticons | forecolor backcolor | code codesample fullscreen ",
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
</script>
@endpush
