@extends('layouts.auth')
@section('title', __('auth.reset_title'))

@section('content')
	<div class="content content-fixed content-auth">
		<div class="container">
			<div class="media align-items-stretch justify-content-center ht-100p">
				<div class="sign-wrapper mg-lg-r-50 mg-xl-r-60">
					<div class="pd-t-20 wd-100p">
						<h4 class="tx-color-01 mg-b-5">{{ __('auth.reset_title') }}</h4>
						
						<form method="POST" action="{{ route('password.update') }}">
							@csrf
							<input type="hidden" name="token" value="{{ $token }}">
							<div class="form-group">
								<label>{{ __('auth.email') }}</label>
								<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" placeholder="{{ __('auth.email_text') }}">
								@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							<div class="form-group">
								<div class="d-flex justify-content-between mg-b-5">
									<label class="mg-b-0-f">{{ __('auth.password') }}</label>
								</div>
								<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('auth.password_text') }}">
								@error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>
							<div class="form-group">
								<div class="d-flex justify-content-between mg-b-5">
									<label class="mg-b-0-f">{{ __('auth.confirm_password') }}</label>
								</div>
								<input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('auth.confirm_password_text') }}">
							</div>

							<button class="btn btn-brand-02 btn-block" type="submit">{{ __('auth.reset_title') }}</button>
						</form>
						<div class="divider-text">{{ __('auth.or') }}</div>
						<div class="tx-13 mg-t-20 tx-center">{{ __('auth.have') }} <a href="{{ route('login') }}">{{ __('auth.signin') }}</a></div>
					</div>
				</div>
				
				<div class="media-body pd-y-30 pd-lg-x-50 pd-xl-x-60 align-items-center d-none d-lg-flex pos-relative">
					<div class="mx-lg-wd-500 mx-xl-wd-550">
						<img src="{{ asset('po-admin/assets/img/img16.png') }}" class="img-fluid" alt="">
					</div>
					<div class="pos-absolute b-0 r-0 tx-12">
						{{ __('auth.design_vector') }} <a href="https://www.freepik.com/pikisuperstar" target="_blank" rel="nofollow">pikisuperstar (freepik.com)</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
