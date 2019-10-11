@extends('layouts.app')
@section('title', __('category.show_title'))

@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-20">
		<div>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb breadcrumb-style1 mg-b-10">
					<li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ __('general.dashboard') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/posts/table') }}">{{ __('general.content') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/categories/table') }}">{{ __('general.categories') }}</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{ __('category.show_title') }}</li>
				</ol>
			</nav>
			<h4 class="mg-b-0 tx-spacing--1">{{ __('category.show_title') }}</h4>
		</div>
		
		<div><a href="{{ url('dashboard/categories/table') }}" class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-t-10"><i data-feather="arrow-left" class="wd-10 mg-r-5"></i> {{ __('general.back') }}</a></div>
	</div>
	
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-striped">
					<tbody>
						<tr>
							<th style="width:180px;">{{ __('category.parent') }}</th><td>{{ $category->parent == 0 ? __('category.no_parent') : '' }}</td>
						</tr>
						<tr>
							<th>{{ __('category.title') }}</th><td>{{ $category->title }}</td>
						</tr>
						<tr>
							<th>{{ __('category.seotitle') }}</th><td>{{ $category->seotitle }}</td>
						</tr>
						<tr>
							<th>{{ __('category.picture') }}</th>
							<td>
								@if($category->picture != '')
									<a href="{{ asset('po-content/uploads/'.$category->picture) }}" target="_blank">{{ __('category.see_image') }}</a>
								@endif
							</td>
						</tr>
						<tr>
							<th>{{ __('category.active') }}</th><td>{{ $category->active == 'Y' ? __('category.active') : __('category.deactive') }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
