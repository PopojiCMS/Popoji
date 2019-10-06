@extends('layouts.app')
@section('title', 'View Settings')

@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-20">
		<div>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb breadcrumb-style1 mg-b-10">
					<li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/users/table') }}">User</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/settings/table') }}">Settings</a></li>
					<li class="breadcrumb-item active" aria-current="page">View Settings</li>
				</ol>
			</nav>
			<h4 class="mg-b-0 tx-spacing--1">View Settings</h4>
		</div>
		
		<div><a href="{{ url('dashboard/settings/table') }}" class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-t-10"><i data-feather="arrow-left" class="wd-10 mg-r-5"></i> Back</a></div>
	</div>
	
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-striped">
					<tbody>
						<tr>
							<th>Group</th><td>{{ $setting->groups }}</td>
						</tr>
						<tr>
							<th>Options</th><td>{{ $setting->options }}</td>
						</tr>
						<tr>
							<th>Value</th><td>{{ $setting->value }}</td>
						</tr>
						<tr>
							<th>Usage</th><td><code>getSetting('{{ $setting->options }}')</code></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
