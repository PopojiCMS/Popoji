@extends('layouts.app')
@section('title', __('theme.datatable_title'))

@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-20">
		<div>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb breadcrumb-style1 mg-b-10">
					<li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ __('general.dashboard') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/themes/table') }}">{{ __('general.appearance') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/themes/table') }}">{{ __('general.themes') }}</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{ __('theme.datatable_list') }}</li>
				</ol>
			</nav>
			<h4 class="mg-b-0 tx-spacing--1">{{ __('theme.datatable_list') }}</h4>
		</div>
		
		<div><a href="{{ url('dashboard/themes/install') }}" class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-t-10"><i data-feather="plus" class="wd-10 mg-r-5"></i> {{ __('general.add') }}</a></div>
	</div>
	
	<div class="card">
		<div class="card-body">
			<div class="row">
				@foreach($themes as $theme)
					<div class="col-md-3 col-sm-4">
						<figure class="pos-relative mg-b-0">
							<img src="{{ asset('po-content/frontend/'.$theme->folder.'/preview.jpg') }}" class="img-fit-cover" alt="" />
							<figcaption class="pos-absolute b-0 l-0 wd-100p pd-20 d-flex justify-content-center">
								<div class="btn-group">
									@if($theme->active == 'N')
										<a href="{{ url('dashboard/themes/active/'.Hashids::encode($theme->id)) }}" class="btn btn-dark btn-icon" title="{{ __('theme.active') }}" data-toggle="tooltip" data-placement="top"><i data-feather="check"></i></a>
									@endif
									<a href="{{ url('dashboard/themes/'.Hashids::encode($theme->id)) }}" class="btn btn-dark btn-icon" title="{{ __('general.view') }}" data-toggle="tooltip" data-placement="top"><i data-feather="eye"></i></a>
									<a href="{{ url('dashboard/themes/'.Hashids::encode($theme->id)) }}" class="btn btn-dark btn-icon" data-delete="" title="{{ __('general.delete') }}" data-toggle="tooltip" data-placement="top"><i data-feather="trash-2"></i></a>
								</div>
							</figcaption>
						</figure>
						<h5 class="mg-t-10">{{ $theme->title }}</h5>
					</div>
				@endforeach
			</div>
		</div>
	</div>
@endsection
