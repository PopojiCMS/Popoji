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
	<link href="{{ asset('po-admin/lib/datatables.net-dt/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('po-admin/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css') }}" rel="stylesheet">
	<link href="{{ asset('po-admin/lib/select2/css/select2.min.css') }}" rel="stylesheet">
	<link href="{{ asset('po-admin/lib/sweetalert/sweetalert2.min.css') }}" rel="stylesheet">
	<link href="{{ asset('po-admin/lib/nestable/jquery.nestable.css') }}" rel="stylesheet">
	<link href="{{ asset('po-content/filemanager/fancybox/jquery.fancybox.css') }}" rel="stylesheet">
	
	@stack('styles')
	
	<link href="{{ asset('po-admin/assets/css/dashforge.css') }}" rel="stylesheet">
	
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
				<li class="nav-label">{{ __('general.dashboard') }}</li>
				<li class="nav-item"><a href="{{ url('/dashboard') }}" class="nav-link"><i data-feather="tv"></i> <span>{{ __('general.dashboard') }}</span></a></li>
				<li class="nav-label mg-t-25">{{ __('general.content') }}</li>
				<li class="nav-item"><a href="{{ url('/dashboard/posts/table') }}" class="nav-link"><i data-feather="book-open"></i> <span>{{ __('general.posts') }}</span></a></li>
				<li class="nav-item"><a href="{{ url('/dashboard/categories/table') }}" class="nav-link"><i data-feather="folder-plus"></i> <span>{{ __('general.categories') }}</span></a></li>
				<li class="nav-item"><a href="{{ url('/dashboard/tags/table') }}" class="nav-link"><i data-feather="bookmark"></i> <span>{{ __('general.tags') }}</span></a></li>
				<li class="nav-item"><a href="{{ url('/dashboard/comments/table') }}" class="nav-link"><i data-feather="message-square"></i> <span>{{ __('general.comments') }}</span></a></li>
				<li class="nav-item"><a href="{{ url('/dashboard/pages/table') }}" class="nav-link"><i data-feather="file-text"></i> <span>{{ __('general.pages') }}</span></a></li>
				<li class="nav-label mg-t-25">{{ __('general.appearance') }}</li>
				<li class="nav-item"><a href="{{ url('/dashboard/themes/table') }}" class="nav-link"><i data-feather="aperture"></i> <span>{{ __('general.themes') }}</span></a></li>
				<li class="nav-item"><a href="{{ url('/dashboard/menu-manager') }}" class="nav-link"><i data-feather="list"></i> <span>{{ __('general.menu_manager') }}</span></a></li>
				<li class="nav-item"><a href="{{ url('/dashboard/settings') }}" class="nav-link"><i data-feather="settings"></i> <span>{{ __('general.settings') }}</span></a></li>
				<li class="nav-label mg-t-25">{{ __('general.component') }}</li>
				<li class="nav-item"><a href="{{ url('/dashboard/components/table') }}" class="nav-link"><i data-feather="package"></i> <span>{{ __('general.components') }}</span></a></li>
				<li class="nav-item"><a href="{{ url('/dashboard/gallerys/table') }}" class="nav-link"><i data-feather="image"></i> <span>{{ __('general.gallerys') }}</span></a></li>
				<li class="nav-item"><a href="{{ url('/dashboard/contacts/table') }}" class="nav-link"><i data-feather="mail"></i> <span>{{ __('general.contacts') }}</span></a></li>
				<!-- <li class="nav-item"><a href="{{ url('/dashboard/clark') }}" class="nav-link"><i data-feather="command"></i> <span>{{ __('general.clark') }}</span></a></li> !-->
				<li class="nav-label mg-t-25">{{ __('general.user') }}</li>
				<li class="nav-item"><a href="{{ url('/dashboard/users/table') }}" class="nav-link"><i data-feather="users"></i> <span>{{ __('general.users') }}</span></a></li>
				<li class="nav-item"><a href="{{ url('/dashboard/roles/table') }}" class="nav-link"><i data-feather="life-buoy"></i> <span>{{ __('general.roles') }}</span></a></li>
				<li class="nav-item"><a href="{{ url('/dashboard/permissions/table') }}" class="nav-link"><i data-feather="shield"></i> <span>{{ __('general.permissions') }}</span></a></li>
			</ul>
		</div>
    </aside>
	
	<div class="content ht-100v pd-0">
		<div class="content-header">
			<div class="content-search">
				<i data-feather="search"></i>
				<input type="search" class="form-control data-search" placeholder="{{ __('general.search') }}...">
			</div>
			
			<div class="row">
				<nav class="nav mt-2 mr-4 d-none d-sm-block">
					<a href="{{ url('/') }}" class="nav-link" target="_blank" data-toggle="tooltip" data-placement="left" title="{{ __('general.view_front_page') }}"><i data-feather="home"></i></a>
				</nav>
				
				<div class="navbar-right pr-3">
					<div class="dropdown dropdown-profile">
						<a href="#" class="dropdown-link" data-toggle="dropdown" data-display="static">
							@if (Auth::user()->picture == '')
							<div class="avatar avatar-sm"><img src="{{ asset('po-admin/assets/img/avatar.jpg') }}" class="rounded-circle" alt=""></div>
							@else
								@if (Auth::user()->hasRole('member'))
									<div class="avatar avatar-sm"><img src="{{ asset('po-content/uploads/users/user-' . Auth::user()->id . '/medium/medium_' . Auth::user()->picture) }}" class="rounded-circle" alt=""></div>
								@else
									<div class="avatar avatar-sm"><img src="{{ asset('po-content/uploads/medium/medium_' . Auth::user()->picture) }}" class="rounded-circle" alt=""></div>
								@endif
							@endif
						</a>
						
						<div class="dropdown-menu dropdown-menu-right tx-13">
							<h6 class="tx-semibold mg-b-5">{{ Auth::user()->name }}</h6>
							<p class="mg-b-25 tx-12 tx-color-03">{{ Auth::user()->email }}</p>
							<a href="{{ url('/dashboard/users/'.Hashids::encode(Auth::user()->id).'/edit') }}" class="dropdown-item"><i data-feather="edit-3"></i> {{ __('general.edit_profile') }}</a>
							@if (Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin'))
								<a href="{{ url('/dashboard/settings') }}" class="dropdown-item"><i data-feather="settings"></i> {{ __('general.settings') }}</a>
							@endif
							<div class="dropdown-divider"></div>
							<a href="http://www.popojicms.org/contact" class="dropdown-item" target="_blank"><i data-feather="help-circle"></i> {{ __('general.help') }}</a>
							<a href="https://www.facebook.com/popojicms/?ref=bookmarks" class="dropdown-item" target="_blank"><i data-feather="life-buoy"></i> {{ __('general.forum') }}</a>
							<a href="javascript:void(0);" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i data-feather="log-out"></i> {{ __('general.sign_out') }}</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="content-body">
			<div class="container">
				@if (Session::has('flash_message'))
					<div class="alert-main">
						<div class="pos-absolute t-10 r-10">
							<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="opacity:1;">
								<div class="toast-header">
									<h6 class="tx-inverse tx-14 mg-b-0 mg-r-auto">{{ __('general.notification') }}</h6>
									<button type="button" class="ml-2 mb-1 close tx-normal" data-dismiss="toast" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="toast-body bg-gray-100">{{ __('general.message') }} : {{ Session::get('flash_message') }}</div>
							</div>
						</div>
					</div>
				@endif
				
				@yield('content')
			</div>
		</div>
	</div>
	
	<div class="modal alertalldel" id="alertalldel" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-md modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-body m-3 text-center">
					<div class="swal2-icon swal2-warning" style="display:flex;"><span class="swal2-icon-text">!</span></div>
					<h3>{{ __('general.delete_1') }}</h3>
					<p class="mb-0">{{ __('general.delete_2') }}</p>
				</div>
				<div class="modal-footer modal-action-footer text-center mb-3">
					<div class="mx-auto" style="width:200px;">
						<button type="button" class="btn btn-danger btn-loading-overlay" id="confirmdel" autofocus>{{ __('general.yes') }}</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('general.cancel') }}</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	@yield('modal')

	<script src="{{ asset('po-admin/lib/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('po-admin/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('po-admin/lib/feather-icons/feather.min.js') }}"></script>
	<script src="{{ asset('po-admin/lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
	<script src="{{ asset('po-admin/lib/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('po-admin/lib/datatables.net-dt/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ asset('po-admin/lib/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('po-admin/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js') }}"></script>
	<script src="{{ asset('po-admin/lib/select2/js/select2.min.js') }}"></script>
	<script src="{{ asset('po-admin/lib/sweetalert/sweetalert2.min.js') }}"></script>
	<script src="{{ asset('po-admin/lib/nestable/jquery.nestable.js') }}"></script>
	<script src="{{ asset('po-content/filemanager/fancybox/jquery.fancybox.js') }}"></script>
	<script src="{{ asset('po-admin/assets/js/dashforge.aside.js') }}"></script>
	<script src="{{ asset('po-admin/lib/js-cookie/js.cookie.js') }}"></script>
	
	@stack('scripts')
	
	<script src="{{ asset('po-admin/assets/js/dashforge.js') }}"></script>
	<script src="{{ asset('po-admin/assets/js/popoji-main.js') }}"></script>
</body>
</html>