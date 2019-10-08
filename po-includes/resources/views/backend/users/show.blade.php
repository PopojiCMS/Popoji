@extends('layouts.app')
@section('title', __('user.show_title'))

@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-20">
		<div>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb breadcrumb-style1 mg-b-10">
					<li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ __('general.dashboard') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/users/table') }}">{{ __('general.user') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/users/table') }}">{{ __('general.users') }}</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{ __('user.show_title') }}</li>
				</ol>
			</nav>
			<h4 class="mg-b-0 tx-spacing--1">{{ __('user.show_title') }}</h4>
		</div>
		
		<div><a href="{{ url('dashboard/users/table') }}" class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-t-10"><i data-feather="arrow-left" class="wd-10 mg-r-5"></i> {{ __('general.back') }}</a></div>
	</div>
	
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-9 mb-2">
					<div class="table-responsive">
						<table class="table table-striped">
							<tbody>
								<tr>
									<th style="width:180px;">{{ __('user.username') }}</th><td>{{ $user->username }}</td>
								</tr>
								<tr>
									<th>{{ __('user.name') }}</th><td>{{ $user->name }}</td>
								</tr>
								<tr>
									<th>{{ __('user.email') }}</th><td>{{ $user->email }}</td>
								</tr>
								<tr>
									<th>{{ __('user.telephone') }}</th><td>{{ $user->telp }}</td>
								</tr>
								<tr>
									<th>{{ __('user.bio') }}</th><td>{{ $user->bio }}</td>
								</tr>
								<tr>
									<th>{{ __('user.block') }}</th><td>{{ $user->active == 'Y' ? __('user.block') : __('user.unblock') }}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-md-3">
					@if (Auth::user()->picture == '')
					<img src="{{ asset('po-admin/assets/img/avatar.jpg') }}" class="img-fluid rounded-circle" alt="">
					@else
						@if (Auth::user()->hasRole('member'))
							<img src="{{ asset('po-content/uploads/users/user-' . Auth::user()->id . '/' . Auth::user()->picture) }}" class="img-fluid rounded-circle" alt="">
						@else
							<img src="{{ asset('po-content/uploads/' . Auth::user()->picture) }}" class="img-fluid rounded-circle" alt="">
						@endif
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection
