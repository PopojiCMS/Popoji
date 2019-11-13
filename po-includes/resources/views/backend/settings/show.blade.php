@extends('layouts.app')
@section('title', __('setting.show_title'))

@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-20">
		<div>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb breadcrumb-style1 mg-b-10">
					<li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ __('general.dashboard') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/themes/table') }}">{{ __('general.appearance') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/settings') }}">{{ __('general.settings') }}</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{ __('setting.show_title') }}</li>
				</ol>
			</nav>
			<h4 class="mg-b-0 tx-spacing--1">{{ __('setting.show_title') }}</h4>
		</div>
		
		<div><a href="{{ url('dashboard/settings') }}" class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-t-10"><i data-feather="arrow-left" class="wd-10 mg-r-5"></i> {{ __('general.back') }}</a></div>
	</div>
	
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-striped">
					<tbody>
						<tr>
							<th style="width:180px;">{{ __('setting.group') }}</th><td>{{ $setting->groups }}</td>
						</tr>
						<tr>
							<th>{{ __('setting.options') }}</th><td>{{ $setting->options }}</td>
						</tr>
						<tr>
							<th>{{ __('setting.value') }}</th><td>{{ $setting->value }}</td>
						</tr>
						<tr>
							<th>{{ __('setting.usage') }}</th><td><code>getSetting('{{ $setting->options }}')</code></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
