@extends('layouts.app')
@section('title', __('pages.show_title'))

@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-20">
		<div>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb breadcrumb-style1 mg-b-10">
					<li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ __('general.dashboard') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/posts/table') }}">{{ __('general.content') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/pages/table') }}">{{ __('general.pages') }}</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{ __('pages.show_title') }}</li>
				</ol>
			</nav>
			<h4 class="mg-b-0 tx-spacing--1">{{ __('pages.show_title') }}</h4>
		</div>
		
		<div><a href="{{ url('dashboard/pages/table') }}" class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-t-10"><i data-feather="arrow-left" class="wd-10 mg-r-5"></i> {{ __('general.back') }}</a></div>
	</div>
	
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-striped">
					<tbody>
						<tr>
							<th style="width:180px;">{{ __('pages.title') }}</th><td>{{ $pages->title }}</td>
						</tr>
						<tr>
							<th>{{ __('pages.seotitle') }}</th><td>{{ $pages->seotitle }}</td>
						</tr>
						<tr>
							<th>{{ __('pages.content') }}</th><td>{!! $pages->content !!}</td>
						</tr>
						<tr>
							<th>{{ __('pages.picture') }}</th>
							<td>
								@if($pages->picture != '')
									<a href="{{ asset('po-content/uploads/'.$pages->picture) }}" target="_blank">{{ __('pages.see_image') }}</a>
								@endif
							</td>
						</tr>
						<tr>
							<th>{{ __('pages.active') }}</th><td>{{ $pages->active == 'Y' ? __('pages.active') : __('pages.deactive') }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
