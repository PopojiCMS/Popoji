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

	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.png') }}">
	<link href="{{ asset('po-admin/lib/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
	<link href="{{ asset('po-admin/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">

	<link rel="stylesheet" href="{{ asset('po-admin/assets/css/dashforge.css') }}">
	
	@stack('styles')
	
	<script>
		window.Laravel = <?php echo json_encode([
			'csrfToken' => csrf_token(),
		]); ?>
	</script>
</head>
<body>
	<aside class="aside aside-fixed">
        <div class="aside-header">
            <a href="{{ url('/dashboard') }}" class="aside-logo pt-2">POPOJI</a>
            <a href="#" class="aside-menu-link pt-1">
                <i data-feather="menu"></i>
                <i data-feather="x"></i>
            </a>
        </div>
        <div class="aside-body">
			<ul class="nav nav-aside">
				<li class="nav-label">Dashboard</li>
				<li class="nav-item"><a href="{{ url('/dashboard') }}" class="nav-link"><i data-feather="tv"></i> <span>Dashboard</span></a></li>
				<li class="nav-label mg-t-25">Content</li>
				<li class="nav-item"><a href="{{ url('/dashboard') }}" class="nav-link"><i data-feather="book-open"></i> <span>Posts</span></a></li>
				<li class="nav-item"><a href="{{ url('/dashboard') }}" class="nav-link"><i data-feather="folder-plus"></i> <span>Categories</span></a></li>
				<li class="nav-item"><a href="{{ url('/dashboard') }}" class="nav-link"><i data-feather="bookmark"></i> <span>Tags</span></a></li>
				<li class="nav-item"><a href="{{ url('/dashboard') }}" class="nav-link"><i data-feather="message-square"></i> <span>Comments</span></a></li>
				<li class="nav-item"><a href="{{ url('/dashboard') }}" class="nav-link"><i data-feather="file-text"></i> <span>Pages</span></a></li>
				<li class="nav-label mg-t-25">Appearance</li>
				<li class="nav-item"><a href="{{ url('/dashboard') }}" class="nav-link"><i data-feather="aperture"></i> <span>Themes</span></a></li>
				<li class="nav-item"><a href="{{ url('/dashboard') }}" class="nav-link"><i data-feather="list"></i> <span>Menu Manager</span></a></li>
				<li class="nav-item"><a href="{{ url('/dashboard') }}" class="nav-link"><i data-feather="settings"></i> <span>Settings</span></a></li>
				<li class="nav-label mg-t-25">Component</li>
				<li class="nav-item"><a href="{{ url('/dashboard') }}" class="nav-link"><i data-feather="package"></i> <span>Components</span></a></li>
				<li class="nav-item"><a href="{{ url('/dashboard') }}" class="nav-link"><i data-feather="command"></i> <span>Clark</span></a></li>
				<li class="nav-label mg-t-25">User</li>
				<li class="nav-item"><a href="{{ url('/dashboard') }}" class="nav-link"><i data-feather="users"></i> <span>Users</span></a></li>
				<li class="nav-item"><a href="{{ url('/dashboard') }}" class="nav-link"><i data-feather="life-buoy"></i> <span>Roles</span></a></li>
				<li class="nav-item"><a href="{{ url('/dashboard') }}" class="nav-link"><i data-feather="shield"></i> <span>Permissions</span></a></li>
			</ul>
		</div>
    </aside>
	
	<div class="content ht-100v pd-0">
		<div class="content-header">
			<div class="content-search">
				<i data-feather="search"></i>
				<input type="search" class="form-control" placeholder="Search...">
			</div>
			
			<div class="row">
				<nav class="nav mt-2 mr-4 d-none d-sm-block">
					<a href="{{ url('/') }}" class="nav-link" target="_blank" data-toggle="tooltip" data-placement="left" title="View Front Page"><i data-feather="home"></i></a>
				</nav>
				
				<div class="navbar-right pr-3">
					<div class="dropdown dropdown-profile">
						<a href="#" class="dropdown-link" data-toggle="dropdown" data-display="static">
							<div class="avatar avatar-sm"><img src="{{ asset('po-admin/assets/img/img1.png') }}" class="rounded-circle" alt=""></div>
						</a>
						
						<div class="dropdown-menu dropdown-menu-right tx-13">
							<h6 class="tx-semibold mg-b-5">{{ Auth::user()->name }}</h6>
							<p class="mg-b-25 tx-12 tx-color-03">{{ Auth::user()->email }}</p>
							<a href="{{ url('/dashboard/users/'.Hashids::encode(Auth::user()->id).'/edit') }}" class="dropdown-item"><i data-feather="edit-3"></i> Edit Profile</a>
							<a href="{{ url('/dashboard/settings/table') }}" class="dropdown-item"><i data-feather="settings"></i> Settings</a>
							<div class="dropdown-divider"></div>
							<a href="http://www.popojicms.org/contact" class="dropdown-item" target="_blank"><i data-feather="help-circle"></i> Help Center</a>
							<a href="https://www.facebook.com/popojicms/?ref=bookmarks" class="dropdown-item" target="_blank"><i data-feather="life-buoy"></i> Forum</a>
							<a href="javascript:void(0);" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i data-feather="log-out"></i> Sign Out</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		@yield('content')
	</div>

	<script src="{{ asset('po-admin/lib/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('po-admin/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('po-admin/lib/feather-icons/feather.min.js') }}"></script>
	<script src="{{ asset('po-admin/lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

	<script src="{{ asset('po-admin/assets/js/dashforge.aside.js') }}"></script>
	<script src="{{ asset('po-admin/assets/js/dashforge.js') }}"></script>

	<script src="{{ asset('po-admin/lib/js-cookie/js.cookie.js') }}"></script>
	
	@stack('scripts')
</body>
</html>