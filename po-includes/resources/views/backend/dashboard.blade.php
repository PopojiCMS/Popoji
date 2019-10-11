@extends('layouts.app')
@section('title', __('dashboard.dashboard_title'))

@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-20">
		<div>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb breadcrumb-style1 mg-b-10">
					<li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ __('general.dashboard') }}</a></li>
				</ol>
			</nav>
			<h4 class="mg-b-0 tx-spacing--1">{{ __('dashboard.welcome_text') }}</h4>
		</div>
		
		<div class="d-none d-md-block">
			<button class="btn btn-sm pd-x-15 btn-white btn-uppercase"><i data-feather="bar-chart-2" class="wd-10 mg-r-5"></i> {{ __('dashboard.analytic') }}</button>
		</div>
	</div>
	
	<div class="card card-body ht-lg-100 mb-3">
		<div class="media">
			<span class="tx-color-04"><i data-feather="home" class="wd-60 ht-60"></i></span>
			<div class="media-body mg-l-20">
				<h6 class="mg-b-10 text-uppercase">{{ __('dashboard.welcome') }}</h6>
				<p class="tx-color-03 mg-b-0">{{ __('dashboard.welcome_to') }} {{ config('app.name') }}. {{ __('dashboard.please_click') }}</p>
			</div>
		</div>
	</div>
	
	@if($commentunread > 0)
	<div class="card card-body ht-lg-100 mb-3">
		<div class="media">
			<span class="tx-primary"><i data-feather="alert-circle" class="wd-60 ht-60"></i></span>
			<div class="media-body mg-l-20">
				<h6 class="mg-b-10">{{ __('dashboard.notifications') }}</h6>
				<p class="tx-color-03 mg-b-0">{{ __('dashboard.notif_comment', ['count' => $commentunread]) }}</p>
			</div>
		</div>
	</div>
	@endif
	
	@if($contactunread > 0)
	<div class="card card-body ht-lg-100 mb-3">
		<div class="media">
			<span class="tx-primary"><i data-feather="alert-circle" class="wd-60 ht-60"></i></span>
			<div class="media-body mg-l-20">
				<h6 class="mg-b-10">{{ __('dashboard.notifications') }}</h6>
				<p class="tx-color-03 mg-b-0">{{ __('dashboard.notif_contact', ['count' => $contactunread]) }}</p>
			</div>
		</div>
	</div>
	@endif
	
	<div class="row row-xs">
		<div class="col-sm-6 col-lg-3 mb-3">
			<div class="card card-body">
				<div class="media">
					<div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-primary tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded">
						<i data-feather="book-open"></i>
					</div>
					<div class="media-body">
						<h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold tx-nowrap mg-b-5 mg-md-b-8">{{ __('dashboard.total_posts') }}</h6>
						<h4 class="tx-20 tx-sm-18 tx-md-20 tx-normal tx-rubik mg-b-0">{{ $post }}</h4>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-lg-3 mb-3">
			<div class="card card-body">
				<div class="media">
					<div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-success tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded">
						<i data-feather="folder-plus"></i>
					</div>
					<div class="media-body">
						<h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold tx-nowrap mg-b-5 mg-md-b-8">{{ __('dashboard.total_categories') }}</h6>
						<h4 class="tx-20 tx-sm-18 tx-md-20 tx-normal tx-rubik mg-b-0">{{ $category }}</h4>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-lg-3 mb-3">
			<div class="card card-body">
				<div class="media">
					<div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-warning tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded">
						<i data-feather="bookmark"></i>
					</div>
					<div class="media-body">
						<h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold tx-nowrap mg-b-5 mg-md-b-8">{{ __('dashboard.total_tags') }}</h6>
						<h4 class="tx-20 tx-sm-18 tx-md-20 tx-normal tx-rubik mg-b-0">{{ $tag }}</h4>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-lg-3 mb-3">
			<div class="card card-body">
				<div class="media">
					<div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-danger tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded">
						<i data-feather="message-square"></i>
					</div>
					<div class="media-body">
						<h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold tx-nowrap mg-b-5 mg-md-b-8">{{ __('dashboard.total_comments') }}</h6>
						<h4 class="tx-20 tx-sm-18 tx-md-20 tx-normal tx-rubik mg-b-0">{{ $comment }}</h4>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-sm-6 col-lg-3 mb-3">
			<div class="card card-body">
				<div class="media">
					<div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-warning tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded">
						<i data-feather="file-text"></i>
					</div>
					<div class="media-body">
						<h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold tx-nowrap mg-b-5 mg-md-b-8">{{ __('dashboard.total_pages') }}</h6>
						<h4 class="tx-20 tx-sm-18 tx-md-20 tx-normal tx-rubik mg-b-0">{{ $pages }}</h4>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-lg-3 mb-3">
			<div class="card card-body">
				<div class="media">
					<div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-danger tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded">
						<i data-feather="package"></i>
					</div>
					<div class="media-body">
						<h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold tx-nowrap mg-b-5 mg-md-b-8">{{ __('dashboard.total_components') }}</h6>
						<h4 class="tx-20 tx-sm-18 tx-md-20 tx-normal tx-rubik mg-b-0">{{ $component }}</h4>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-lg-3 mb-3">
			<div class="card card-body">
				<div class="media">
					<div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-primary tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded">
						<i data-feather="aperture"></i>
					</div>
					<div class="media-body">
						<h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold tx-nowrap mg-b-5 mg-md-b-8">{{ __('dashboard.total_themes') }}</h6>
						<h4 class="tx-20 tx-sm-18 tx-md-20 tx-normal tx-rubik mg-b-0">{{ $theme }}</h4>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-lg-3 mb-3">
			<div class="card card-body">
				<div class="media">
					<div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-success tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded">
						<i data-feather="users"></i>
					</div>
					<div class="media-body">
						<h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold tx-nowrap mg-b-5 mg-md-b-8">{{ __('dashboard.total_users') }}</h6>
						<h4 class="tx-20 tx-sm-18 tx-md-20 tx-normal tx-rubik mg-b-0">{{ $user }}</h4>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('po-admin/assets/css/dashforge.dashboard.css') }}">
@endpush

@push('scripts')

@endpush
