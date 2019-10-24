@extends('layouts.app')
@section('title', __('dashboard.analytics_title'))

@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-20">
		<div>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb breadcrumb-style1 mg-b-10">
					<li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ __('general.dashboard') }}</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{ __('dashboard.analytics_title') }}</li>
				</ol>
			</nav>
			<h4 class="mg-b-0 tx-spacing--1">{{ __('dashboard.analytics_title') }}</h4>
		</div>
		
		<div class="d-none d-md-block">
			<a href="{{ url('dashboard') }}" class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-t-10"><i data-feather="arrow-left" class="wd-10 mg-r-5"></i> {{ __('general.back') }}</a>
		</div>
	</div>
	
	<div class="row row-xs">
		<div class="col-lg-3 mg-t-10">
			<div class="card">
				<div class="card-header">
					<h6 class="mg-b-0">{{ __('dashboard.realtime_users') }}</h6>
				</div>
				<div class="card-body tx-center">
					<h4 class="tx-normal tx-rubik tx-50 tx-spacing--1 mg-b-0">{{ $fetchRealtimeUsers }}</h4>
					<p class="tx-18 tx-uppercase tx-semibold tx-spacing-1 tx-color-02">{{ __('general.users') }}</p>
					<p class="tx-12 tx-color-03 mg-b-0">{{ __('dashboard.please_refresh') }}</p>
				</div>
			</div>
		</div>
		
		<div class="col-lg-9 mg-t-10">
		
		</div>
		
		<div class="col-lg-6 mg-t-10">
			<div class="card">
				<div class="card-header d-flex align-items-start justify-content-between">
					<h6 class="lh-5 mg-b-0">{{ __('dashboard.total_visits') }}</h6>
					<a href="" class="tx-13 link-03">{{ __('dashboard.in_7_days') }}</a>
				</div>
				<div class="card-body pd-y-15 pd-x-10">
					<div class="table-responsive">
						<table class="table table-borderless table-sm tx-13 tx-nowrap mg-b-0">
							<thead>
								<tr class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase">
									<th class="wd-5p">{{ __('dashboard.link') }}</th>
									<th>{{ __('dashboard.page_title') }}</th>
									<th class="text-right">{{ __('dashboard.value') }}</th>
								</tr>
							</thead>
							<tbody>
								@foreach($fetchMostVisitedPages as $mvp)
									<tr>
										<td class="align-middle text-center"><a href="{{ $mvp['url'] }}"><i data-feather="external-link" class="wd-12 ht-12 stroke-wd-3"></i></a></td>
										<td class="align-middle tx-medium">{{ Str::limit($mvp['pageTitle'], 50) }}</td>
										<td class="align-middle text-right"><span class="tx-medium">{{ $mvp['pageViews'] }}</span></td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-lg-6 mg-t-10">
			<div class="card">
				<div class="card-header d-sm-flex align-items-start justify-content-between">
					<h6 class="lh-5 mg-b-0">{{ __('dashboard.browser_used_by_users') }}</h6>
					<a href="" class="tx-13 link-03">{{ __('dashboard.in_7_days') }}</a>
				</div>
				<div class="card-body pd-y-15 pd-x-10">
					<div class="table-responsive">
						<table class="table table-borderless table-sm tx-13 tx-nowrap mg-b-0">
							<thead>
								<tr class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase">
									<th>{{ __('dashboard.browser') }}</th>
									<th class="text-right">{{ __('dashboard.sessions') }}</th>
								</tr>
							</thead>
							<tbody>
								@foreach($fetchTopBrowsers as $tb)
									<tr>
										<td class="tx-medium">{{ $tb['browser'] }}</td>
										<td class="text-right">{{ $tb['sessions'] }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-lg-6 mg-t-10">
			<div class="card">
				<div class="card-header d-sm-flex align-items-start justify-content-between">
					<h6 class="lh-5 mg-b-0">{{ __('dashboard.os_used_by_users') }}</h6>
					<a href="" class="tx-13 link-03">{{ __('dashboard.in_7_days') }}</a>
				</div>
				<div class="card-body pd-y-15 pd-x-10">
					<div class="table-responsive">
						<table class="table table-borderless table-sm tx-13 tx-nowrap mg-b-0">
							<thead>
								<tr class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase">
									<th>{{ __('dashboard.operation_system') }}</th>
									<th class="text-center">{{ __('dashboard.os_version') }}</th>
									<th class="text-right">{{ __('dashboard.sessions') }}</th>
								</tr>
							</thead>
							<tbody>
								@foreach($fetchTopOperatingSystem as $tos)
									<tr>
										<td class="tx-medium">{{ $tos['os'] }}</td>
										<td class="text-center">{{ $tos['version'] }}</td>
										<td class="text-right">{{ $tos['sessions'] }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-lg-6 mg-t-10">
			<div class="card">
				<div class="card-header d-sm-flex align-items-start justify-content-between">
					<h6 class="lh-5 mg-b-0">{{ __('dashboard.users_by_country') }}</h6>
					<a href="" class="tx-13 link-03">{{ __('dashboard.in_7_days') }}</a>
				</div>
				<div class="card-body pd-y-15 pd-x-10">
					<div class="table-responsive">
						<table class="table table-borderless table-sm tx-13 tx-nowrap mg-b-0">
							<thead>
								<tr class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase">
									<th>{{ __('dashboard.country') }}</th>
									<th class="text-right">{{ __('dashboard.sessions') }}</th>
								</tr>
							</thead>
							<tbody>
								@foreach($fetchTopCountry as $tc)
									<tr>
										<td class="tx-medium">{{ $tc['country'] }}</td>
										<td class="text-right">{{ $tc['sessions'] }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
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
