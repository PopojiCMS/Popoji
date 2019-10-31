<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{{ str_replace('_', '-', app()->getLocale()) }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="robots" content="index, follow" />
    <meta name="generator" content="{{ config('app.version') }}" />
    <meta name="author" content="{{ getSetting('web_author') }}" />
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	
	{!! SEO::generate() !!}
	
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('po-content/uploads/'.getSetting('favicon')) }}" />
	<link href="{{ asset('po-content/frontend/inews/css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('po-content/frontend/inews/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('po-content/frontend/inews/css/animate.min.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('po-content/frontend/inews/bootsnav/css/bootsnav.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('po-content/frontend/inews/css/RYPP.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('po-content/frontend/inews/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('po-content/frontend/inews/themify-icons/themify-icons.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('po-content/frontend/inews/weather-icons/css/weather-icons.min.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('po-content/frontend/inews/css/flaticon.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('po-content/frontend/inews/owl-carousel/owl.carousel.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('po-content/frontend/inews/owl-carousel/owl.theme.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('po-content/frontend/inews/owl-carousel/owl.transitions.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('po-content/frontend/inews/css/style.css') }}" rel="stylesheet" type="text/css"/>
	
	@stack('styles')
	
	<script>
		window.Laravel = <?php echo json_encode([
			'csrfToken' => csrf_token(),
		]); ?>
	</script>
	
	{!! NoCaptcha::renderJs() !!}
</head>
<body>
	
	<div class="sub-footer">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-5 col-md-5">
					<div class="copy">Copyright &copy; 2019 {{ getSetting('web_author') }}. All Rights Reserved.</div>
				</div>
				<div class="col-xs-12 col-sm-7 col-md-7">
					<ul class="footer-nav">
						<li><a href="{{ url('pages/about-us') }}">About Us</a></li>
						<li><a href="{{ url('pages/services') }}">Services</a></li>
						<li><a href="{{ url('contact') }}">Contact</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	
	<script src="{{ asset('po-content/frontend/inews/js/jquery.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('po-content/frontend/inews/js/jquery-ui.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('po-content/frontend/inews/js/bootstrap.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('po-content/frontend/inews/bootsnav/js/bootsnav.js') }}" type="text/javascript"></script>
	<script src="{{ asset('po-content/frontend/inews/js/theia-sticky-sidebar.js') }}" type="text/javascript"></script>
	<script src="{{ asset('po-content/frontend/inews/js/RYPP.js') }}" type="text/javascript"></script>
	<script src="{{ asset('po-content/frontend/inews/owl-carousel/owl.carousel.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('po-content/frontend/inews/js/custom.js') }}" type="text/javascript"></script>
	
	@stack('scripts')
</body>
</html>