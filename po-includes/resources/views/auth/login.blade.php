@extends('layouts.auth')
@section('title', __('auth.login_title'))

@section('content')
	<div class="content content-fixed content-auth">
		<div class="container">
			<div class="media align-items-stretch justify-content-center ht-100p pos-relative">
				<div class="media-body align-items-center d-none d-lg-flex">
					<div class="mx-wd-600">
						<img src="{{ asset('po-admin/assets/img/img15.png') }}" class="img-fluid" alt="">
					</div>
					<div class="pos-absolute b-0 l-0 tx-12 tx-center">
						{{ __('auth.design_vector') }} <a href="https://www.freepik.com/pikisuperstar" target="_blank" rel="nofollow">pikisuperstar (freepik.com)</a>
					</div>
				</div>
				
				<div class="sign-wrapper mg-lg-l-50 mg-xl-l-60">
					<div class="wd-100p">
						<h3 class="tx-color-01 mg-b-5">{{ __('auth.signin') }}</h3>
						<p class="tx-color-03 tx-16 mg-b-40">{{ __('auth.signin_intro') }}</p>
						<form method="POST" action="{{ route('login') }}">
							@csrf
							<input type="hidden" name="remember" value="">
							<div class="form-group">
								<label>{{ __('auth.email') }}</label>
								<input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('auth.email_text') }}">
								@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							<div class="form-group">
								<div class="d-flex justify-content-between mg-b-5">
									<label class="mg-b-0-f">{{ __('auth.password') }}</label>
									@if (Route::has('password.request'))
									<a href="{{ route('password.request') }}" class="tx-13">{{ __('auth.forgot_question') }}</a>
									@endif
								</div>
								<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('auth.password_text') }}">
								@error('password')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							<button class="btn btn-brand-02 btn-block" type="submit">{{ __('auth.signin') }}</button>
						</form>
						<div class="divider-text">{{ __('auth.or') }}</div>
						<div class="tx-13 mg-t-20 tx-center">{{ __('auth.dont_have') }} <a href="{{ url('register') }}">{{ __('auth.create_account') }}</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
