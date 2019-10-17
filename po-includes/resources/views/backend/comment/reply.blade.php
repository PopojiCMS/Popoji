@extends('layouts.app')
@section('title', __('comment.reply_title'))

@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-20">
		<div>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb breadcrumb-style1 mg-b-10">
					<li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ __('general.dashboard') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/posts/table') }}">{{ __('general.content') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/comments/table') }}">{{ __('general.comments') }}</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{ __('comment.reply_title') }}</li>
				</ol>
			</nav>
			<h4 class="mg-b-0 tx-spacing--1">{{ __('comment.reply_title') }}</h4>
		</div>
		
		<div><a href="{{ url('dashboard/comments/table') }}" class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-t-10"><i data-feather="arrow-left" class="wd-10 mg-r-5"></i> {{ __('general.back') }}</a></div>
	</div>
	
	<div class="card">
		{!! Form::open(['url' => '/dashboard/comments/post-reply', 'class' => 'form-horizontal']) !!}
			<div class="card-body pd-b-0">
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
				
				@if ($errors->any())
					<ul class="alert alert-danger">
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				@endif
				
				<div class="form-group">
					{!! Form::hidden('parent', $comment->id) !!}
					{!! Form::hidden('post_id', $comment->post_id) !!}
					{!! Form::label('content', __('comment.reply').' *', ['class' => 'control-label']) !!}
					{!! Form::textarea('content', null, ['class' => $errors->has('content') ? 'form-control is-invalid ht-150-i' : 'form-control ht-150-i', 'required' => 'required']) !!}
					{!! $errors->first('content', '<p class="help-block">:message</p>') !!}
				</div>
			</div>
			<div class="card-footer">
				<button type="submit" class="btn btn-primary"><i data-feather="send" class="wd-10 mg-r-5"></i> {{ __('comment.reply') }}</button>
			</div>
		{!! Form::close() !!}
	</div>
@endsection
