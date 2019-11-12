@extends('layouts.app')
@section('title', __('theme.install_title'))

@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-20">
		<div>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb breadcrumb-style1 mg-b-10">
					<li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ __('general.dashboard') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/themes/table') }}">{{ __('general.appearance') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/themes/table') }}">{{ __('general.themes') }}</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{ __('theme.install_title') }}</li>
				</ol>
			</nav>
			<h4 class="mg-b-0 tx-spacing--1">{{ __('theme.install_title') }}</h4>
		</div>
		
		<div><a href="{{ url('dashboard/themes/table') }}" class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-t-10"><i data-feather="arrow-left" class="wd-10 mg-r-5"></i> {{ __('general.back') }}</a></div>
	</div>
	
	<div class="card">
		{!! Form::open(['url' => '/dashboard/themes/process-install', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
			<div class="card-body pd-b-0">
				@if ($errors->any())
					<ul class="alert alert-danger">
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				@endif
				
				<div class="form-group">
					{!! Form::label('files', __('theme.files').' *', ['class' => 'control-label']) !!}
					<div class="custom-file">
						<input type="file" name="files" class="custom-file-input" id="customFile" />
						<label class="custom-file-label" for="customFile">{{ __('general.select_file') }}</label>
					</div>
					{!! $errors->first('files', '<p class="help-block">:message</p>') !!}
				</div>
				
				<div class="bd pd-20 mg-b-20">
					<label class="tx-sans tx-10 tx-medium tx-spacing-1 tx-uppercase tx-color-03 mg-b-10">{{ __('theme.instruction_1') }}</label>
					<ol class="lh-7 mg-b-0">
						<li>{{ __('theme.instruction_2') }}</li>
						<li>{{ __('theme.instruction_3') }}</li>
						<li>{{ __('theme.instruction_4') }}</li>
						<li>{{ __('theme.instruction_5') }}</li>
					</ol>
				</div>
			</div>
			<div class="card-footer">
				<button type="submit" class="btn btn-primary"><i data-feather="settings" class="wd-10 mg-r-5"></i> {{ __('theme.install') }}</button>
			</div>
		{!! Form::close() !!}
	</div>
@endsection

@push('scripts')
<script type="text/javascript">
	$(function() {
		$('#customFile').on('change',function(){
			var fileName = document.getElementById("customFile").files[0].name;
			$(this).next('.custom-file-label').addClass("selected").html(fileName);
		});
	});
</script>
@endpush
