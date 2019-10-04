@extends('layouts.app')
@section('title', '505 Forbidden')

@section('content')
	<div class="content content-auth-alt">
		<div class="container ht-100p tx-center">
			<div class="ht-100p d-flex flex-column align-items-center justify-content-center">
				<div class="wd-70p wd-sm-250 wd-lg-300 mg-b-15"><img src="{{ asset('po-admin/assets/img/img22.png') }}" class="img-fluid" alt=""></div>
				<h1 class="tx-color-01 tx-24 tx-sm-32 tx-lg-36 mg-xl-b-5">505 Forbidden</h1>
				<h5 class="tx-16 tx-sm-18 tx-lg-20 tx-normal mg-b-20">Oopps. Something is broken or check your permission for this page</h5>
				<p class="tx-color-03 mg-b-30">We've been automatically alerted of the issue and will work to fix it asap.</p>
				<div class="mg-b-40"><a href="{{ url('/dashboard') }}" class="btn btn-white bd-2 pd-x-30">Back to Home</a></div>
				<span class="tx-12 tx-color-03">Error page concept with laptop vector is created by <a href="https://www.freepik.com/free-photos-vectors/business" rel="nofollow">freepik (freepik.com)</a></span>
			</div>
		</div>
	</div>
@endsection
