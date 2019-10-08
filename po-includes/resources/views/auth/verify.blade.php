@extends('layouts.auth')
@section('title', __('auth.verify_title'))

@section('content')
	<div class="content content-fixed content-auth-alt">
		<div class="container ht-100p">
			<div class="ht-100p d-flex flex-column align-items-center justify-content-center">
				<div class="wd-150 wd-sm-250 mg-b-30"><img src="{{ asset('po-admin/assets/img/img17.png') }}" class="img-fluid" alt=""></div>
				<h4 class="tx-20 tx-sm-24">{{ __('auth.verify_intro') }}</h4>
				@if (session('resent'))
					<div class="alert alert-success" role="alert">{{ __('auth.verify_resend') }}</div>
				@endif
				<p class="tx-color-03 mg-b-40">@lang('auth.verify_instruction')</p>
				<div class="tx-13 tx-lg-14 mg-b-40">
					<form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
		                <button type="submit" class="btn btn-brand-02 d-inline-flex align-items-center">{{ __('auth.resend_button') }}</button>
	                </form>
					<a href="mailto:{{ getSetting('email') }}" class="btn btn-white d-inline-flex align-items-center mg-l-5">{{ __('auth.contact_support') }}</a>
				</div>
				<span class="tx-12 tx-color-03">{{ __('auth.design_vector') }} <a href="https://www.freepik.com/free-photos-vectors/background" rel="nofollow">freepik (freepik.com)</a></span>
			</div>
		</div>
	</div>
@endsection
