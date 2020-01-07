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

	@if(getSetting('google_analytics_id') != '')
		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', "{{ getSetting('google_analytics_id') }}"]);
			_gaq.push(['_trackPageview']);
			(function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>
	@endif
</head>
<body>
	<header>
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-md-6 col-sm-6 col-lg-6">
						<div class="header-social">
							<ul>
								<li><a href="{{ getSetting('facebook') }}"><i class="fa fa-facebook"></i></a></li>
								<li><a href="{{ getSetting('twitter') }}"><i class="fa fa-twitter"></i></a></li>
								<li><a href="{{ getSetting('youtube') }}"><i class="fa fa-youtube-play"></i></a></li>
							</ul>
						</div>
						<div class="top-left-menu">
							<ul>
								<li><a href="{{ url('contact') }}">Contact</a></li>
								<li><a href="{{ url('pages/about-us') }}">About Us</a></li>
							</ul>
						</div>
					</div>

					<div class="hidden-xs col-md-6 col-sm-6 col-lg-6">
						<div class="header-right-menu">
							<ul>
								<li>
                                    @if(getSetting('member_registration') == 'Y')
                                    <a href="{{ url('register') }}"><i class="fa fa-lock"></i> Sign Up</a> or
                                    @endif
                                    <a href="{{ url('login') }}"> Login</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="header-mid hidden-xs">
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo">
							<a href="{{ url('/') }}"><img src="{{ asset('po-content/uploads/'.getSetting('logo')) }}" class="img-responsive" alt=""></a>
						</div>
					</div>

					<div class="col-sm-8">
						<a href="{{ url('/') }}"><img src="{{ asset('po-content/frontend/inews/images/add728x90-1.jpg') }}" class="img-responsive" alt=""></a>
					</div>
				</div>
			</div>
		</div>

		<nav class="navbar navbar-default navbar-sticky navbar-mobile bootsnav">
			<div class="top-search">
				<div class="container">
					<form method="get" action="{{ url('search') }}">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-search"></i></span>
							<input name="terms" type="text" class="form-control" placeholder="Search">
							<span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
						</div>
					</form>
				</div>
			</div>

			<div class="container">
				<div class="attr-nav">
					<ul>
						<li class="search"><a href="javascript:void(0);"><i class="fa fa-search"></i></a></li>
					</ul>
				</div>
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
						<i class="fa fa-bars"></i>
					</button>
					<a class="navbar-brand hidden-sm hidden-md hidden-lg" href="#brand"><img src="{{ asset('po-content/uploads/'.getSetting('logo')) }}" class="logo" alt=""></a>
				</div>
				<div class="collapse navbar-collapse" id="navbar-menu">
					<ul class="nav navbar-nav navbar-left" data-in="" data-out="">
						@each(getTheme('partials.menu'), getMenus(), 'menu', getTheme('partials.menu'))
					</ul>
				</div>
			</div>
		</nav>
	</header>

	<main class="page_main_wrapper">
		@yield('content')
	</main>

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-sm-4 footer-box">
					<div class="about-inner">
						<img src="{{ asset('po-content/uploads/'.getSetting('logo_footer')) }}" class="img-responsive" alt=""/>
						<p>{{ \Str::limit(strip_tags(getPages(1)->content), 200) }}</p>
						<ul>
							<li><i class="ti-location-arrow"></i>{{ getSetting('address') }}</li>
							<li><i class="ti-mobile"></i>{{ getSetting('telephone') }}</li>
							<li><i class="ti-email"></i>{{ getSetting('email') }}</li>
						</ul>
					</div>
				</div>

				<div class="col-sm-2 footer-box">
					<h3 class="wiget-title">Sitemap</h3>
					<ul class="menu-services">
						<li><a href="{{ url('/') }}">Home</a></li>
						<li><a href="{{ url('pages/about-us') }}">About Us</a></li>
						<li><a href="{{ url('pages/services') }}">Services</a></li>
						<li><a href="{{ url('album/all') }}">Gallery</a></li>
						<li><a href="{{ url('contact') }}">Contact</a></li>
					</ul>
				</div>

				<div class="col-sm-2 footer-box">
					<h3 class="wiget-title">Category</h3>
					<ul class="menu-services">
						@foreach(getCategory(7) as $category)
							<li><a href="{{ url('category/'.$category->seotitle) }}">{{ $category->title }} ({{ $category->posts_count }})</a></li>
						@endforeach
					</ul>
				</div>

				<div class="col-sm-4 footer-box">
					<h3 class="wiget-title">Recent Post</h3>
					<div class="footer-news-grid">
						@foreach(latestPost(2) as $latestpost)
							<div class="news-list-item">
								<div class="img-wrapper">
									<a href="{{ prettyUrl($latestpost) }}" class="thumb">
										<img src="{{ getPicture($latestpost->picture, 'thumb', $latestpost->updated_by) }}" alt="" class="img-responsive">
										@if($latestpost->type == 'picture')
											<div class="link-icon">
												<i class="fa fa-image"></i>
											</div>
										@elseif($latestpost->type == 'video')
											<div class="link-icon">
												<i class="fa fa-camera"></i>
											</div>
										@endif
									</a>
								</div>
								<div class="post-info-2">
									<h5><a href="{{ prettyUrl($latestpost) }}" class="title">{{ $latestpost->title }}</a></h5>
									<ul class="authar-info">
										<li><i class="ti-timer"></i> {{ date('d F Y', strtotime($latestpost->created_at)) }}</li>
									</ul>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</footer>

	<div class="sub-footer">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-5 col-md-5">
					<div class="copy">Copyright &copy; {{ date('Y') }} {{ getSetting('web_author') }}. All Rights Reserved.</div>
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
