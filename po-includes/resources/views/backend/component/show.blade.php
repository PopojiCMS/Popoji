@extends('layouts.app')
@section('title', __('component.show_title'))

@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-20">
		<div>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb breadcrumb-style1 mg-b-10">
					<li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ __('general.dashboard') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/components/table') }}">{{ __('general.components') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/components/table') }}">{{ __('general.components') }}</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{ __('component.show_title') }}</li>
				</ol>
			</nav>
			<h4 class="mg-b-0 tx-spacing--1">{{ __('component.show_title') }}</h4>
		</div>
		
		<div><a href="{{ url('dashboard/components/table') }}" class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-t-10"><i data-feather="arrow-left" class="wd-10 mg-r-5"></i> {{ __('general.back') }}</a></div>
	</div>
	
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-striped">
					<tbody>
						<tr>
							<th style="width:180px;">{{ __('component.title') }}</th><td>{{ $component->title }}</td>
						</tr>
						<tr>
							<th>{{ __('component.author') }}</th><td>{{ $component->author }}</td>
						</tr>
						<tr>
							<th>{{ __('component.folder') }}</th><td>{{ $component->folder }}</td>
						</tr>
						<tr>
							<th>{{ __('component.type') }}</th><td>{{ $component->type == 'component' ? __('component.type_component') : __('component.type_widget') }}</td>
						</tr>
						<tr>
							<th>{{ __('component.active') }}</th><td>{{ $component->active == 'Y' ? __('component.active') : __('component.deactive') }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
