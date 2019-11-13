@extends('layouts.auth')
@section('title', __('auth.reset_title'))

@section('content')
	<div class="content content-fixed content-auth-alt">
		<div class="container d-flex justify-content-center ht-100p">
			<div class="mx-wd-300 wd-sm-450 ht-100p d-flex flex-column align-items-center justify-content-center">
				<div class="wd-80p wd-sm-300 mg-b-15"><img src="{{ asset('po-admin/assets/img/img18.png') }}" class="img-fluid" alt=""></div>
				
				<h4 class="tx-20 tx-sm-24">{{ __('auth.reset_password') }}</h4>
				<p class="tx-color-03 mg-b-30 tx-center">{{ __('auth.reset_password_intro') }}</p>
				
				<form method="POST" action="{{ route('password.email') }}">
					@csrf
					<div class="wd-100p mg-b-40">
						<div class="input-group">
							<input type="email" class="form-control rounded @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('auth.email_text') }}">
							<button class="btn btn-brand-02 mg-sm-l-10" type="submit">{{ __('auth.reset_title') }}</button>
							@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
				</form>
				<span class="tx-12 tx-color-03">{{ __('auth.design_vector') }} <a href="https://www.freepik.com/free-photos-vectors/business" rel="nofollow">freepik (freepik.com)</a></span>
			</div>
		</div>
	</div>
@endsection
