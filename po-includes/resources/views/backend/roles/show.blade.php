@extends('layouts.app')
@section('title', 'View Roles')

@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-20">
		<div>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb breadcrumb-style1 mg-b-10">
					<li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/users/table') }}">User</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/roles/table') }}">Roles</a></li>
					<li class="breadcrumb-item active" aria-current="page">View Roles</li>
				</ol>
			</nav>
			<h4 class="mg-b-0 tx-spacing--1">View Roles</h4>
		</div>
		
		<div><a href="{{ url('dashboard/roles/table') }}" class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-t-10"><i data-feather="arrow-left" class="wd-10 mg-r-5"></i> Back</a></div>
	</div>
	
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-striped">
					<tbody>
						<tr>
							<th>Name</th><td>{{ $role->name }}</td>
						</tr>
						<tr>
							<th>Guard</th><td>{{ $role->guard_name }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
