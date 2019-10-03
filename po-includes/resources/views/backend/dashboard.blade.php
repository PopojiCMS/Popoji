@extends('layouts.app')
@section('title', 'Dashboard Panel')

@section('content')
		<div class="content-body">
			<div class="container pd-x-0">
				<div class="d-sm-flex align-items-center justify-content-between mg-b-10 mg-lg-b-10 mg-xl-b-10">
					<div>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb breadcrumb-style1 mg-b-10">
								<li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
							</ol>
						</nav>
						<h4 class="mg-b-0 tx-spacing--1">Welcome to Dashboard</h4>
					</div>
					
					<div class="d-none d-md-block">
						<button class="btn btn-sm pd-x-15 btn-white btn-uppercase"><i data-feather="bar-chart-2" class="wd-10 mg-r-5"></i> View Web Analytic</button>
					</div>
				</div>
				
				<hr class="mg-y-20">
				
				<div class="card card-body ht-lg-100 mb-3">
					<div class="media">
						<span class="tx-color-04"><i data-feather="home" class="wd-60 ht-60"></i></span>
						<div class="media-body mg-l-20">
							<h6 class="mg-b-10">WELCOME</h6>
							<p class="tx-color-03 mg-b-0">Welcome to {{ config('app.name') }}. Please click menu on the side to discover this system. Thank you!</p>
						</div>
					</div>
				</div>
				
				<!-- <div class="card card-body ht-lg-100 mb-3">
					<div class="media">
						<span class="tx-primary"><i data-feather="alert-circle" class="wd-60 ht-60"></i></span>
						<div class="media-body mg-l-20">
							<h6 class="mg-b-10">Notifications</h6>
							<p class="tx-color-03 mg-b-0">You have 2 new comment</p>
						</div>
					</div>
				</div> !-->
				
				<div class="row row-xs">
					<div class="col-sm-6 col-lg-3 mb-3">
						<div class="card card-body">
							<div class="media">
								<div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-primary tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded">
									<i data-feather="book-open"></i>
								</div>
								<div class="media-body">
									<h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold tx-nowrap mg-b-5 mg-md-b-8">Total Posts</h6>
									<h4 class="tx-20 tx-sm-18 tx-md-20 tx-normal tx-rubik mg-b-0">32</h4>
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
									<h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold tx-nowrap mg-b-5 mg-md-b-8">Total Categories</h6>
									<h4 class="tx-20 tx-sm-18 tx-md-20 tx-normal tx-rubik mg-b-0">6</h4>
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
									<h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold tx-nowrap mg-b-5 mg-md-b-8">Total Tags</h6>
									<h4 class="tx-20 tx-sm-18 tx-md-20 tx-normal tx-rubik mg-b-0">15</h4>
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
									<h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold tx-nowrap mg-b-5 mg-md-b-8">Total Comments</h6>
									<h4 class="tx-20 tx-sm-18 tx-md-20 tx-normal tx-rubik mg-b-0">7</h4>
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
									<h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold tx-nowrap mg-b-5 mg-md-b-8">Total Pages</h6>
									<h4 class="tx-20 tx-sm-18 tx-md-20 tx-normal tx-rubik mg-b-0">11</h4>
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
									<h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold tx-nowrap mg-b-5 mg-md-b-8">Total Components</h6>
									<h4 class="tx-20 tx-sm-18 tx-md-20 tx-normal tx-rubik mg-b-0">2</h4>
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
									<h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold tx-nowrap mg-b-5 mg-md-b-8">Total Themes</h6>
									<h4 class="tx-20 tx-sm-18 tx-md-20 tx-normal tx-rubik mg-b-0">3</h4>
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
									<h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold tx-nowrap mg-b-5 mg-md-b-8">Total Users</h6>
									<h4 class="tx-20 tx-sm-18 tx-md-20 tx-normal tx-rubik mg-b-0">3</h4>
								</div>
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
