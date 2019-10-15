@extends('layouts.app')
@section('title', __('menumanager.datatable_title'))

@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-20">
		<div>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb breadcrumb-style1 mg-b-10">
					<li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ __('general.dashboard') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/themes/table') }}">{{ __('general.appearance') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/menu-manager') }}">{{ __('general.menu_manager') }}</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{ __('menumanager.datatable_list') }}</li>
				</ol>
			</nav>
			<h4 class="mg-b-0 tx-spacing--1">{{ __('menumanager.datatable_list') }}</h4>
		</div>
		
		<div><a href="{{ url('dashboard/menu-manager/table') }}" class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-t-10"><i data-feather="grid" class="wd-10 mg-r-5"></i> {{ __('menumanager.table') }}</a></div>
	</div>
	
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-8">
					<div class="mg-b-10" id="success-indicator" style="display:none;">
						<div class="alert alert-success" role="alert">
							<strong>{{ __('menumanager.info') }}: </strong> {{ __('menumanager.success') }}
						</div>
					</div>
					<div>
						<input type="hidden" id="nestable-output" />
						<div class="dd" id="nestable">
							<ol class="dd-list">
								@if(count($menu) > 0)
									@each('backend.menumanager.menu', $menu, 'menu', 'backend.menumanager.menu')
								@endif
							</ol>
						</div>
					</div>
				</div>
				
				<div class="col-md-4">
					<div class="card">
						<div class="card-header bg-gray-200 pd-t-10 pd-b-10">{{ __('menumanager.info') }}</div>
						<div class="card-body">{{ __('menumanager.info_text') }}</div>
					</div>
					
					<div class="card mg-t-20">
						<div class="card-header bg-gray-200 pd-t-10 pd-b-10">{{ __('menumanager.create_title') }}</div>
						{!! Form::open(['url' => '/dashboard/menu-manager', 'class' => 'form-horizontal']) !!}
							<div class="card-body pd-b-0">
								@if ($errors->any())
									<ul class="alert alert-danger">
										@foreach ($errors->all() as $error)
											<li>{{ $error }}</li>
										@endforeach
									</ul>
								@endif
								
								@include ('backend.menumanager.form', ['formMode' => 'create'])
							</div>
							<div class="card-footer">
								<button type="submit" class="btn btn-primary btn-block"><i data-feather="send" class="wd-10 mg-r-5"></i> {{ __('general.create') }}</button>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
<script type="text/javascript">
	$(function() {
	    var updateOutput = function(e){
			var list   = e.length ? e : $(e.target),
				output = list.data('output');
			if (window.JSON) {
				output.val(window.JSON.stringify(list.nestable('serialize')));
			} else {
				output.val('JSON browser support required for this demo.');
			}
		};
		
		$('#nestable').nestable().on('change', updateOutput);
		
		updateOutput($('#nestable').data('output', $('#nestable-output')));
		
		$('.dd').on('change', function() {
			$("#success-indicator").hide();
			var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
			var dataString = { 
				data : $("#nestable-output").val(),
				_token : CSRF_TOKEN
			};
			$.ajax({
				type: 'POST',
				url: '{{ url("dashboard/menu-manager/menusort") }}',
				data: dataString,
				cache : false,
				success: function(data){
					$("#success-indicator").show();
				}
			});
		});
	});
</script>
@endpush
