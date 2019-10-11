@extends('layouts.app')
@section('title', __('album.show_title'))

@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-20">
		<div>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb breadcrumb-style1 mg-b-10">
					<li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ __('general.dashboard') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/components/table') }}">{{ __('general.components') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/albums/table') }}">{{ __('general.albums') }}</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{ __('album.show_title') }}</li>
				</ol>
			</nav>
			<h4 class="mg-b-0 tx-spacing--1">{{ __('album.show_title') }}</h4>
		</div>
		
		<div><a href="{{ url('dashboard/albums/table') }}" class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-t-10"><i data-feather="arrow-left" class="wd-10 mg-r-5"></i> {{ __('general.back') }}</a></div>
	</div>
	
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-striped">
					<tbody>
						<tr>
							<th style="width:180px;">{{ __('album.title') }}</th><td>{{ $album->title }}</td>
						</tr>
						<tr>
							<th>{{ __('album.seotitle') }}</th><td>{{ $album->seotitle }}</td>
						</tr>
						<tr>
							<th>{{ __('album.active') }}</th><td>{{ $album->active == 'Y' ? __('album.active') : __('album.deactive') }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
