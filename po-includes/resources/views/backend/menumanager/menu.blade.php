@if ((count($menu->children) > 0) && ($menu->parent_id > 0))
	<li data-id="{{ $menu->id }}" class="dd-item dd3-item">
		<div class="dd-handle dd3-handle"></div>
		<div class="dd3-content">
			<div class="d-flex justify-content-between">
				<div>{{ $menu->title }} &nbsp;&nbsp;&nbsp; {{ $menu->url }}</div>
				<div class="btn-group btn-group-xs">
					<a href="{{ url('dashboard/menu-manager/'.Hashids::encode($menu->id).'/edit') }}" class="btn btn-primary btn-xs btn-icon" title="{{ __('general.edit') }}" data-toggle="tooltip" data-placement="top"><i class="fa fa-edit"></i></a> | 
					<a href="{{ url('dashboard/menu-manager/'.Hashids::encode($menu->id)) }}" class="btn btn-danger btn-xs btn-icon" title="{{ __('general.delete') }}" data-delete="" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash"></i></a>
				</div>
			</div>
		</div>
@else
	<li data-id="{{ $menu->id }}" class="dd-item dd3-item">
		<div class="dd-handle dd3-handle"></div>
		<div class="dd3-content">
			<div class="d-flex justify-content-between">
				<div>{{ $menu->title }} &nbsp;&nbsp;&nbsp; {{ $menu->url }}</div>
				<div class="btn-group btn-group-xs">
					<a href="{{ url('dashboard/menu-manager/'.Hashids::encode($menu->id).'/edit') }}" class="btn btn-primary btn-xs btn-icon" title="{{ __('general.edit') }}" data-toggle="tooltip" data-placement="top"><i class="fa fa-edit"></i></a>
					<a href="{{ url('dashboard/menu-manager/'.Hashids::encode($menu->id)) }}" class="btn btn-danger btn-xs btn-icon" title="{{ __('general.delete') }}" data-delete="" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash"></i></a>
				</div>
			</div>
		</div>
@endif
	@if (count($menu->children) > 0)
	<ol style="" class="dd-list">
		@foreach($menu->children as $menu)
			@include('backend.menumanager.menu', $menu)
		@endforeach
	</ol>
	@endif
</li>
