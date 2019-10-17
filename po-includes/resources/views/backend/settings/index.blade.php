@extends('layouts.app')
@section('title', __('setting.datatable_title'))

@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-20">
		<div>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb breadcrumb-style1 mg-b-10">
					<li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ __('general.dashboard') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/themes/table') }}">{{ __('general.appearance') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/dashboard/settings/table') }}">{{ __('general.settings') }}</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{ __('setting.datatable_list') }}</li>
				</ol>
			</nav>
			<h4 class="mg-b-0 tx-spacing--1">{{ __('setting.datatable_list') }}</h4>
		</div>
		
		<div>
			<a href="{{ url('dashboard/settings/table') }}" class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-t-10"><i data-feather="grid" class="wd-10 mg-r-5"></i> {{ __('setting.table') }}</a>
			<a href="{{ url('dashboard/subscribes/table') }}" class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-t-10"><i data-feather="tag" class="wd-10 mg-r-5"></i> {{ __('subscribe.datatable_list') }}</a>
		</div>
	</div>
	
	<ul class="nav nav-tabs nav-justified" id="settingTab" role="tablist">
		@foreach($groups as $group)
			<li class="nav-item">
				<a class="nav-link {{ $group->groups == 'General' ? 'active' : '' }}" id="{{ strtolower($group->groups) }}-tab" data-toggle="tab" href="#{{ strtolower($group->groups) }}" role="tab" aria-controls="{{ strtolower($group->groups) }}" aria-selected="true">{{ $group->groups }}</a>
			</li>
		@endforeach
	</ul>
	<div class="tab-content bd bd-gray-300 bd-t-0 pd-20" id="settingTabContent">
		@foreach($groups as $group)
			<div class="tab-pane {{ $group->groups == 'General' ? 'active' : '' }}" id="{{ strtolower($group->groups) }}" role="tabpanel" aria-labelledby="{{ strtolower($group->groups) }}-tab">
				<div class="table-responsive">
					<table class="table table-striped mg-b-0">
						<tbody>
							@foreach(getSettingGroup($group->groups) as $option)
								@if($option->options == 'sitemap')
									<tr>
										<th width="200">{{ $option->options }}</th>
										<td>{{ url('/'.$option->value) }}</td>
										<td width="120" class="text-center"><a href="{{ url('dashboard/settings/sitemap') }}" class="btn btn-primary btn-xs btn-icon" title="{{ __('setting.generate') }}" data-toggle="tooltip" data-placement="left"><i class="fa fa-edit"></i> {{ __('setting.generate') }}</a></td>
									</tr>
								@elseif($option->options == 'backup')
									<tr>
										<th width="200">{{ $option->options }}</th>
										<td>po-content/backups/backup</td>
										<td width="120" class="text-center"><a href="{{ url('dashboard/settings/backup') }}" class="btn btn-primary btn-xs btn-icon" title="{{ __('setting.generate') }}" data-toggle="tooltip" data-placement="left"><i class="fa fa-edit"></i> {{ __('setting.backup') }}</a></td>
									</tr>
								@else
									<tr>
										<th width="200">{{ $option->options }}</th>
										<td>{{ $option->value }}</td>
										<td width="120" class="text-center"><a href="{{ url('dashboard/settings/'.Hashids::encode($option->id).'/edit') }}" class="btn btn-primary btn-xs btn-icon" title="{{ __('general.edit') }}" data-toggle="tooltip" data-placement="left"><i class="fa fa-edit"></i> {{ __('general.edit') }}</a></td>
									</tr>
								@endif
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		@endforeach
	</div>
@endsection
