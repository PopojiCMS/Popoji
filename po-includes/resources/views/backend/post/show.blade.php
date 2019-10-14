@extends('layouts.app')
@section('title', __('post.show_title'))

@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-20">
		<div>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb breadcrumb-style1 mg-b-10">
					<li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ __('general.dashboard') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/posts/table') }}">{{ __('general.content') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/posts/table') }}">{{ __('general.posts') }}</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{ __('post.show_title') }}</li>
				</ol>
			</nav>
			<h4 class="mg-b-0 tx-spacing--1">{{ __('post.show_title') }}</h4>
		</div>
		
		<div><a href="{{ url('dashboard/posts/table') }}" class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-t-10"><i data-feather="arrow-left" class="wd-10 mg-r-5"></i> {{ __('general.back') }}</a></div>
	</div>
	
	<div class="card">
		<div class="card-body">
			<div class="col-md-10 offset-1">
				<h2>{{ $post->title }}</h2>
				
				<ul class="list-inline">
					<li class="list-inline-item">Category : {{ $post->category->title }}</li>
					<li class="list-inline-item">Status : {{ $post->active == 'Y' ? __('post.active') : __('post.deactive') }}</li>
					<li class="list-inline-item">Headline : {{ $post->headline == 'Y' ? __('general.yes') : __('general.no') }}</li>
					<li class="list-inline-item">Comment : {{ $post->comment == 'Y' ? __('post.active') : __('post.deactive') }}</li>
				</ul>
				
				@if($post->picture != '')
					<p><img src="{{ asset('po-content/uploads/'.$post->picture) }}" class="img-fluid" /></p>
				@endif
				{!! $post->content !!}
				
				<p>Tags : {{ $post->tag }}</p>
			</div>
		</div>
	</div>
@endsection
