@extends('layouts.auth')
@section('title', 'Verify Email')

@section('content')
	<div class="content content-fixed content-auth-alt">
		<div class="container ht-100p">
			<div class="ht-100p d-flex flex-column align-items-center justify-content-center">
				<div class="wd-150 wd-sm-250 mg-b-30"><img src="{{ asset('po-admin/assets/img/img17.png') }}" class="img-fluid" alt=""></div>
				<h4 class="tx-20 tx-sm-24">Verify your email address</h4>
				@if (session('resent'))
					<div class="alert alert-success" role="alert">A fresh verification link has been sent to your email address.</div>
				@endif
				<p class="tx-color-03 mg-b-40">Before proceeding, please check your email for a verification link.<br />If you did not receive the email</p>
				<div class="tx-13 tx-lg-14 mg-b-40">
					<form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
		                <button type="submit" class="btn btn-brand-02 d-inline-flex align-items-center">Resend Verification</button>
	                </form>
					<a href="#" class="btn btn-white d-inline-flex align-items-center mg-l-5">Contact Support</a>
				</div>
				<span class="tx-12 tx-color-03">Mailbox with envelope vector is created by <a href="https://www.freepik.com/free-photos-vectors/background" rel="nofollow">freepik (freepik.com)</a></span>
			</div>
		</div>
	</div>
@endsection
