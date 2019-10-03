@extends('layouts.auth')
@section('title', 'Reset Password')

@section('content')
	<div class="content content-fixed content-auth-alt">
		<div class="container d-flex justify-content-center ht-100p">
			<div class="mx-wd-300 wd-sm-450 ht-100p d-flex flex-column align-items-center justify-content-center">
				<div class="wd-80p wd-sm-300 mg-b-15"><img src="{{ asset('po-admin/assets/img/img18.png') }}" class="img-fluid" alt=""></div>
				
				<h4 class="tx-20 tx-sm-24">Reset your password</h4>
				<p class="tx-color-03 mg-b-30 tx-center">Enter your username or email address and we will send you a link to reset your password.</p>
				
				<form method="POST" action="{{ route('password.email') }}">
					@csrf
					<div class="wd-100p mg-b-40">
						<div class="input-group">
							<input type="email" class="form-control rounded @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter email address">
							<button class="btn btn-brand-02 mg-sm-l-10" type="submit">Reset Password</button>
							@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
				</form>
				<span class="tx-12 tx-color-03">Key business concept vector is created by <a href="https://www.freepik.com/free-photos-vectors/business" rel="nofollow">freepik (freepik.com)</a></span>
			</div>
		</div>
	</div>
@endsection
