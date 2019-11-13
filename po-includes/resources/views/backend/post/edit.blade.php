@extends('layouts.app')
@section('title', __('post.edit_title'))

@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-20">
		<div>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb breadcrumb-style1 mg-b-10">
					<li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ __('general.dashboard') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/posts/table') }}">{{ __('general.content') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/posts/table') }}">{{ __('general.posts') }}</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{ __('post.edit_title') }}</li>
				</ol>
			</nav>
			<h4 class="mg-b-0 tx-spacing--1">{{ __('post.edit_title') }}</h4>
		</div>
		
		<div><a href="{{ url('dashboard/posts/table') }}" class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-t-10"><i data-feather="arrow-left" class="wd-10 mg-r-5"></i> {{ __('general.back') }}</a></div>
	</div>
	
	<div class="card">
		{!! Form::model($post, [
			'method' => 'PATCH',
			'url' => ['/dashboard/posts', Hashids::encode($post->id)],
			'class' => 'form-horizontal'
		]) !!}
			<div class="card-body pd-b-0">
				@if ($errors->any())
					<ul class="alert alert-danger">
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				@endif
				
				@include ('backend.post.form', ['formMode' => 'edit'])
			</div>
			<div class="card-footer">
				<button type="submit" class="btn btn-primary"><i data-feather="send" class="wd-10 mg-r-5"></i> {{ __('general.update') }}</button>
			</div>
		{!! Form::close() !!}
	</div>
@endsection

@section('modal')
	<div class="alert-gallery" style="display:none;">
		<div class="pos-absolute t-10 r-10">
			<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="opacity:1;">
				<div class="toast-header">
					<h6 class="tx-inverse tx-14 mg-b-0 mg-r-auto">{{ __('post.notification') }}</h6>
					<button type="button" class="ml-2 mb-1 close tx-normal" data-dismiss="toast" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="toast-body bg-gray-100">{{ __('post.error_gallery') }}</div>
			</div>
		</div>
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
	
	$(document).ready(function() {
		$('.btn-add-gallery').on('click', function() {
			var title = $("#picture-title").val();
			var picture = $("#picture-url").val();
			var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
			var dataString = {
				post_id : {{ $post->id }},
				title : title,
				picture : picture,
				_token : CSRF_TOKEN
			};
			if (title == '' || picture == '') {
				$(".alert-gallery").fadeTo(2000, 500).slideUp(1000, function(){
					$(".alert-gallery").alert('close');
				});
			} else {
				$.ajax({
					type: 'POST',
					url: '{{ url("dashboard/posts/create-gallery") }}',
					data: dataString,
					cache : false,
					success: function(result){
						if (result.code == '2000') {
							$('#box-gallery').append('\
								<div class="col-md-4" id="box-item-gallery-'+ result.data.id +'">\
									<figure class="pos-relative mg-b-10">\
										<img src="'+ result.data.picture +'" class="img-fit-cover" alt="" />\
										<figcaption class="pos-absolute b-0 l-0 wd-100p pd-20">\
											<h6 class="tx-white tx-semibold mg-b-20">'+ result.data.title +'</h6>\
											<div class="d-flex justify-content-center">\
												<div class="btn-group">\
													<a href="javascript:void(0);" class="btn btn-dark btn-icon btn-remove-gallery" id="'+ result.data.id +'"><i class="fa fa-trash"></i> {{ __("general.delete") }}</a>\
												</div>\
											</div>\
										</figcaption>\
									</figure>\
								</div>\
							');
							$("#picture-title").val('');
							$("#picture-url").val('');
						} else {
							$(".alert-gallery").fadeTo(2000, 500).slideUp(1000, function(){
								$(".alert-gallery").alert('close');
							});
						}
					}
				});
			}
		});
		
		$(document).on('click', '.btn-remove-gallery', function(e){
			var id = $(this).attr('id');
			var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
			var dataString = {
				id : id,
				_token : CSRF_TOKEN
			};
			$.ajax({
				type: 'POST',
				url: '{{ url("dashboard/posts/delete-gallery") }}',
				data: dataString,
				cache : false,
				success: function(result){
					if (result.code == '2000') {
						$('#box-item-gallery-' + id).hide();
					} else {
						$(".alert-gallery").fadeTo(2000, 500).slideUp(1000, function(){
							$(".alert-gallery").alert('close');
						});
					}
				}
			});
		});
	});
</script>
@endpush
