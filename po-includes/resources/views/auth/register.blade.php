@extends('layouts.auth')
@section('title', 'Sign Up Panel')

@section('content')
	<div class="content content-fixed content-auth">
		<div class="container">
			<div class="media align-items-stretch justify-content-center ht-100p">
				<div class="sign-wrapper mg-lg-r-50 mg-xl-r-60">
					<div class="pd-t-20 wd-100p">
						<h4 class="tx-color-01 mg-b-5">Create New Account</h4>
						<p class="tx-color-03 tx-16 mg-b-40">It's free to signup and only takes a minute.</p>
						
						<form method="POST" action="{{ route('register') }}">
							@csrf
							<div class="form-group">
								<label>Fullname</label>
								<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Enter your name">
								@error('name')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							<div class="form-group">
								<label>Email address</label>
								<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your email address">
								@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							<div class="form-group">
								<div class="d-flex justify-content-between mg-b-5">
									<label class="mg-b-0-f">Password</label>
								</div>
								<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter your password">
								@error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>
							<div class="form-group">
								<div class="d-flex justify-content-between mg-b-5">
									<label class="mg-b-0-f">Confirm Password</label>
								</div>
								<input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Enter your password again">
							</div>
							<div class="form-group tx-12">
								By clicking <strong>Create an account</strong> below, you agree to our terms of service and privacy statement.
							</div>

							<button class="btn btn-brand-02 btn-block" type="submit">Create Account</button>
						</form>
						<div class="divider-text">or</div>
						<div class="tx-13 mg-t-20 tx-center">Already have an account? <a href="{{ route('login') }}">Sign In</a></div>
					</div>
				</div>
				
				<div class="media-body pd-y-30 pd-lg-x-50 pd-xl-x-60 align-items-center d-none d-lg-flex pos-relative">
					<div class="mx-lg-wd-500 mx-xl-wd-550">
						<img src="{{ asset('po-admin/assets/img/img16.png') }}" class="img-fluid" alt="">
					</div>
					<div class="pos-absolute b-0 r-0 tx-12">
						Social media marketing vector is created by <a href="https://www.freepik.com/pikisuperstar" target="_blank" rel="nofollow">pikisuperstar (freepik.com)</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
