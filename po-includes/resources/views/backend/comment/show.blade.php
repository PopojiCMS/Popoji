@extends('layouts.app')
@section('title', __('comment.show_title'))

@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-20">
		<div>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb breadcrumb-style1 mg-b-10">
					<li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ __('general.dashboard') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/posts/table') }}">{{ __('general.content') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/comments/table') }}">{{ __('general.comments') }}</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{ __('comment.show_title') }}</li>
				</ol>
			</nav>
			<h4 class="mg-b-0 tx-spacing--1">{{ __('comment.show_title') }}</h4>
		</div>
		
		<div><a href="{{ url('dashboard/comments/table') }}" class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-t-10"><i data-feather="arrow-left" class="wd-10 mg-r-5"></i> {{ __('general.back') }}</a></div>
	</div>
	
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-striped">
					<tbody>
						<tr>
							<th style="width:180px;">{{ __('comment.name') }}</th><td>{{ $comment->name }}</td>
						</tr>
						<tr>
							<th>{{ __('comment.email') }}</th><td>{{ $comment->email }}</td>
						</tr>
						<tr>
							<th>{{ __('comment.content') }}</th><td>{{ $comment->content }}</td>
						</tr>
						<tr>
							<th>{{ __('comment.active') }}</th><td>{{ $comment->active == 'Y' ? __('comment.publish') : __('comment.unpublish') }}</td>
						</tr>
						<tr>
							<th>{{ __('comment.status') }}</th><td>{{ $comment->status == 'Y' ? __('comment.read') : __('comment.unread') }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
