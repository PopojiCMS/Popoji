@extends('layouts.app')
@section('title', __('tag.edit_title'))

@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-20">
		<div>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb breadcrumb-style1 mg-b-10">
					<li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ __('general.dashboard') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/posts/table') }}">{{ __('general.content') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/tags/table') }}">{{ __('general.tags') }}</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{ __('tag.edit_title') }}</li>
				</ol>
			</nav>
			<h4 class="mg-b-0 tx-spacing--1">{{ __('tag.edit_title') }}</h4>
		</div>
		
		<div><a href="{{ url('dashboard/tags/table') }}" class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-t-10"><i data-feather="arrow-left" class="wd-10 mg-r-5"></i> {{ __('general.back') }}</a></div>
	</div>
	
	<div class="card">
		{!! Form::model($tag, [
			'method' => 'PATCH',
			'url' => ['/dashboard/tags', Hashids::encode($tag->id)],
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
				
				@include ('backend.tags.form', ['formMode' => 'edit'])
			</div>
			<div class="card-footer">
				<button type="submit" class="btn btn-primary"><i data-feather="send" class="wd-10 mg-r-5"></i> {{ __('general.update') }}</button>
			</div>
		{!! Form::close() !!}
	</div>
@endsection

@push('styles')
<link href="{{ asset('po-admin/lib/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{ asset('po-admin/lib/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
@endpush
