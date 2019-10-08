<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{{ str_replace('_', '-', app()->getLocale()) }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="@yield('title')" />
    <meta name="generator" content="{{ config('app.version') }}" />
    <meta name="author" content="POPOJI" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
	<title>@yield('title') - {{ config('app.name') }}</title>
	
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('po-content/uploads/'.getSetting('favicon')) }}">
	<link href="{{ asset('po-admin/lib/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
	<link href="{{ asset('po-admin/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
	
	<link rel="stylesheet" href="{{ asset('po-admin/assets/css/dashforge.css') }}">
	<link rel="stylesheet" href="{{ asset('po-admin/assets/css/dashforge.auth.css') }}">
</head>
<body>
	<header class="navbar navbar-header navbar-header-fixed">
		<div class="navbar-brand">
			<a href="{{ url('/') }}" class="df-logo pt-2">POPOJI</a>
		</div>
		
		<div class="navbar-right">
			<a href="{{ getSetting('facebook') }}" class="btn btn-social"><i class="fab fa-facebook"></i></a>
			<a href="{{ getSetting('twitter') }}" class="btn btn-social"><i class="fab fa-twitter"></i></a>
			<a href="https://www.github.com/PopojiCMS/Popoji" class="btn btn-social"><i class="fab fa-github"></i></a>
		</div>
	</header>
	
	@yield('content')
	
	<footer class="footer">
		<div>
			<span>&copy; 2013-<?=date('Y');?> Popoji V.{{ config('app.version') }}</span>
			<span>{{ __('auth.created') }} <a href="http://www.themepixels.me" rel="nofollow">ThemePixels</a></span>
		</div>
		<div>
			<nav class="nav">
				<a href="https://www.opensource.org/licenses/MIT" class="nav-link">{{ __('auth.license') }}</a>
				<a href="http://www.popojicms.org/pages/changelog" class="nav-link">{{ __('auth.changelog') }}</a>
				<a href="http://www.popojicms.org/contact" class="nav-link">{{ __('auth.help') }}</a>
			</nav>
		</div>
	</footer>
	
	<script src="{{ asset('po-admin/lib/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('po-admin/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('po-admin/lib/feather-icons/feather.min.js') }}"></script>
	<script src="{{ asset('po-admin/lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
	
	<script src="{{ asset('po-admin/assets/js/dashforge.js') }}"></script>
	
	<script src="{{ asset('po-admin/lib/js-cookie/js.cookie.js') }}"></script>
</body>
</html>