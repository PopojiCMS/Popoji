@extends('layouts.app')
@section('title', __('tag.show_title'))

@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-20">
		<div>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb breadcrumb-style1 mg-b-10">
					<li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ __('general.dashboard') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/posts/table') }}">{{ __('general.content') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/tags/table') }}">{{ __('general.tags') }}</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{ __('tag.show_title') }}</li>
				</ol>
			</nav>
			<h4 class="mg-b-0 tx-spacing--1">{{ __('tag.show_title') }}</h4>
		</div>
		
		<div><a href="{{ url('dashboard/tags/table') }}" class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-t-10"><i data-feather="arrow-left" class="wd-10 mg-r-5"></i> {{ __('general.back') }}</a></div>
	</div>
	
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-striped">
					<tbody>
						<tr>
							<th style="width:180px;">{{ __('tag.title') }}</th><td>{{ $tag->title }}</td>
						</tr>
						<tr>
							<th>{{ __('tag.seotitle') }}</th><td>{{ $tag->seotitle }}</td>
						</tr>
						<tr>
							<th>{{ __('tag.count') }}</th><td>{{ $tag->count }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
