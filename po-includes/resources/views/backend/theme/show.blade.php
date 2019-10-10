@extends('layouts.app')
@section('title', __('theme.show_title'))

@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-20">
		<div>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb breadcrumb-style1 mg-b-10">
					<li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ __('general.dashboard') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/themes/table') }}">{{ __('general.appearance') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/themes/table') }}">{{ __('general.themes') }}</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{ __('theme.show_title') }}</li>
				</ol>
			</nav>
			<h4 class="mg-b-0 tx-spacing--1">{{ __('theme.show_title') }}</h4>
		</div>
		
		<div><a href="{{ url('dashboard/themes/table') }}" class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-t-10"><i data-feather="arrow-left" class="wd-10 mg-r-5"></i> {{ __('general.back') }}</a></div>
	</div>
	
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-striped">
					<tbody>
						<tr>
							<th style="width:180px;">{{ __('theme.title') }}</th><td>{{ $theme->title }}</td>
						</tr>
						<tr>
							<th>{{ __('theme.author') }}</th><td>{{ $theme->author }}</td>
						</tr>
						<tr>
							<th>{{ __('theme.folder') }}</th><td>{{ $theme->folder }}</td>
						</tr>
						<tr>
							<th>{{ __('theme.active') }}</th><td>{{ $theme->active == 'Y' ? __('theme.active') : __('theme.deactive') }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
