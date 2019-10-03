@extends('layouts.auth')
@section('title', 'Sign In Panel')

@section('content')
	<div class="content content-fixed content-auth">
		<div class="container">
			<div class="media align-items-stretch justify-content-center ht-100p pos-relative">
				<div class="media-body align-items-center d-none d-lg-flex">
					<div class="mx-wd-600">
						<img src="{{ asset('po-admin/assets/img/img15.png') }}" class="img-fluid" alt="">
					</div>
					<div class="pos-absolute b-0 l-0 tx-12 tx-center">
						Workspace design vector is created by <a href="https://www.freepik.com/pikisuperstar" target="_blank" rel="nofollow">pikisuperstar (freepik.com)</a>
					</div>
				</div>
				
				<div class="sign-wrapper mg-lg-l-50 mg-xl-l-60">
					<div class="wd-100p">
						<h3 class="tx-color-01 mg-b-5">Sign In</h3>
						<p class="tx-color-03 tx-16 mg-b-40">Welcome back! Please signin to continue.</p>
						<form method="POST" action="{{ route('login') }}">
							@csrf
							<input type="hidden" name="remember" value="">
							<div class="form-group">
								<label>Email address</label>
								<input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="yourname@yourmail.com">
								@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							<div class="form-group">
								<div class="d-flex justify-content-between mg-b-5">
									<label class="mg-b-0-f">Password</label>
									@if (Route::has('password.request'))
									<a href="{{ route('password.request') }}" class="tx-13">Forgot password?</a>
									@endif
								</div>
								<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">
								@error('password')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							<button class="btn btn-brand-02 btn-block" type="submit">Sign In</button>
						</form>
						<div class="divider-text">or</div>
						<div class="tx-13 mg-t-20 tx-center">Don't have an account? <a href="{{ route('register') }}">Create an Account</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
