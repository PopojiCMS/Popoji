@extends('layouts.app')
@section('title', __('contact.reply_title'))

@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-20">
		<div>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb breadcrumb-style1 mg-b-10">
					<li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ __('general.dashboard') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/components/table') }}">{{ __('general.components') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/contacts/table') }}">{{ __('general.contacts') }}</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{ __('contact.reply_title') }}</li>
				</ol>
			</nav>
			<h4 class="mg-b-0 tx-spacing--1">{{ __('contact.reply_title') }}</h4>
		</div>
		
		<div><a href="{{ url('dashboard/contacts/table') }}" class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-t-10"><i data-feather="arrow-left" class="wd-10 mg-r-5"></i> {{ __('general.back') }}</a></div>
	</div>
	
	<div class="card">
		{!! Form::open(['url' => '/dashboard/contacts/post-reply', 'class' => 'form-horizontal']) !!}
			<div class="card-body pd-b-0">
				<div class="table-responsive">
					<table class="table table-striped">
						<tbody>
							<tr>
								<th style="width:180px;">{{ __('contact.name') }}</th><td>{{ $contact->name }}</td>
							</tr>
							<tr>
								<th>{{ __('contact.email') }}</th><td>{{ $contact->email }}</td>
							</tr>
							<tr>
								<th>{{ __('contact.subject') }}</th><td>{{ $contact->subject }}</td>
							</tr>
							<tr>
								<th>{{ __('contact.message') }}</th><td>{{ $contact->message }}</td>
							</tr>
							<tr>
								<th>{{ __('contact.status') }}</th><td>{{ $contact->status == 'Y' ? __('contact.read') : __('contact.unread') }}</td>
							</tr>
							<tr>
								<th>{{ __('contact.created_at') }}</th><td>{{ date('d M y H:i', strtotime($contact->created_at)) }}</td>
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
					{!! Form::hidden('id', $contact->id) !!}
					{!! Form::label('message', __('contact.reply').' *', ['class' => 'control-label']) !!}
					{!! Form::textarea('message', null, ['class' => $errors->has('message') ? 'form-control is-invalid ht-150-i' : 'form-control ht-150-i', 'required' => 'required']) !!}
					{!! $errors->first('message', '<p class="help-block">:message</p>') !!}
				</div>
			</div>
			<div class="card-footer">
				<button type="submit" class="btn btn-primary"><i data-feather="send" class="wd-10 mg-r-5"></i> {{ __('contact.reply') }}</button>
			</div>
		{!! Form::close() !!}
	</div>
@endsection
