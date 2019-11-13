@extends('layouts.app')
@section('title', __('menumanager.show_title'))

@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-20">
		<div>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb breadcrumb-style1 mg-b-10">
					<li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ __('general.dashboard') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/themes/table') }}">{{ __('general.appearance') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/menu-manager') }}">{{ __('general.menu_manager') }}</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{ __('menumanager.show_title') }}</li>
				</ol>
			</nav>
			<h4 class="mg-b-0 tx-spacing--1">{{ __('menumanager.show_title') }}</h4>
		</div>
		
		<div><a href="{{ url('dashboard/menu-manager') }}" class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-t-10"><i data-feather="arrow-left" class="wd-10 mg-r-5"></i> {{ __('general.back') }}</a></div>
	</div>
	
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-striped">
					<tbody>
						<tr>
							<th style="width:180px;">{{ __('menumanager.parent') }}</th><td>{{ $menumanager->parent == 0 ? __('menumanager.no_parent') : '' }}</td>
						</tr>
						<tr>
							<th>{{ __('menumanager.group') }}</th><td>{{ $menumanager->group }}</td>
						</tr>
						<tr>
							<th>{{ __('menumanager.title') }}</th><td>{{ $menumanager->title }}</td>
						</tr>
						<tr>
							<th>{{ __('menumanager.url') }}</th><td>{{ $menumanager->url }}</td>
						</tr>
						<tr>
							<th>{{ __('menumanager.class') }}</th><td>{{ $menumanager->class }}</td>
						</tr>
						<tr>
							<th>{{ __('menumanager.target') }}</th><td>{{ $menumanager->target }}</td>
						</tr>
						<tr>
							<th>{{ __('menumanager.position') }}</th><td>{{ $menumanager->position }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
