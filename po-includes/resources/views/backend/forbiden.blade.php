@extends('layouts.app')
@section('title', __('error.forbiden_title'))

@section('content')
	<div class="content content-auth-alt">
		<div class="container ht-100p tx-center">
			<div class="ht-100p d-flex flex-column align-items-center justify-content-center">
				<div class="wd-70p wd-sm-250 wd-lg-300 mg-b-15"><img src="{{ asset('po-admin/assets/img/img22.png') }}" class="img-fluid" alt=""></div>
				<h1 class="tx-color-01 tx-24 tx-sm-32 tx-lg-36 mg-xl-b-5">{{ __('error.forbiden_title') }}</h1>
				<h5 class="tx-16 tx-sm-18 tx-lg-20 tx-normal mg-b-20">{{ __('error.forbiden_text_2') }}</h5>
				<p class="tx-color-03 mg-b-30">{{ __('error.forbiden_text_2') }}</p>
				<div class="mg-b-40"><a href="{{ url('/dashboard') }}" class="btn btn-white bd-2 pd-x-30">{{ __('general.back_to_home') }}</a></div>
				<span class="tx-12 tx-color-03">{{ __('auth.design_vector') }} <a href="https://www.freepik.com/free-photos-vectors/business" rel="nofollow">freepik (freepik.com)</a></span>
			</div>
		</div>
	</div>
@endsection
