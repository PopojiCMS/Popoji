@extends(getTheme('layouts.app'))

@section('content')
	<div class="page-title">&nbsp;</div>
	
	<div class="container">
		<div class="row row-m">
			<div class="col-sm-8 col-p main-content">
				<div class="theiaStickySidebar">
					<div class="post-inner">
						<div class="post-head">
							@if(isset($album))
								<h2 class="title">{{ $album->title }} ({{ $gallerys->total() }})</h2>
							@else
								<h2 class="title">All Album</h2>
							@endif
						</div>
						
						<div class="post-body">
							<div class="news-grid-2">
								<div class="row">
									@if(isset($album))
										@foreach($gallerys as $gallery)
											<div class="col-xs-6 col-sm-4 col-md-4">
												<div class="grid-item">
													<div class="grid-item-img">
														<a href="{{ getPicture($gallery->picture, 'original', $gallery->updated_by) }}" class="gallery" title="{{ $gallery->title }}" rel="album-gallery">
															<img src="{{ getPicture($gallery->picture, 'medium', $gallery->updated_by) }}" class="img-responsive" alt="">
															<div class="link-icon"><i class="fa fa-camera"></i></div>
														</a>
													</div>
													<h5><a href="{{ getPicture($gallery->picture, 'original', $gallery->updated_by) }}" class="gallery title" title="{{ $gallery->title }}" rel="album-gallery">{{ $gallery->title }}</a></h5>
												</div>
											</div>
										@endforeach
									@else
										@foreach($gallerys as $gallery)
											<div class="col-xs-6 col-sm-4 col-md-4">
												<div class="grid-item">
													<div class="grid-item-img">
														<a href="{{ url('album/'.$gallery->seotitle) }}">
															<img src="{{ getPicture($gallery->gallerys[0]->picture, 'medium', $gallery->gallerys[0]->updated_by) }}" class="img-responsive" alt="">
															<div class="link-icon"><i class="fa fa-camera"></i></div>
														</a>
													</div>
													<h5><a href="{{ url('album/'.$gallery->seotitle) }}" class="title">{{ $gallery->title }} ({{ count($gallery->gallerys) }})</a></h5>
												</div>
											</div>
										@endforeach
									@endif
								</div>
							</div>
						</div>
						
						<div class="post-footer"> 
							<div class="row thm-margin">
								<div class="col-xs-12 col-sm-12 col-md-12 thm-padding">
									{{ $gallerys->links() }}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-sm-4 col-p rightSidebar">
				@include(getTheme('partials.sidebar'))
			</div>
		</div>
	</div>
@endsection

@push('styles')
<link href="{{ asset('po-content/filemanager/fancybox/jquery.fancybox.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{ asset('po-content/filemanager/fancybox/jquery.fancybox.js') }}"></script>

<script type="text/javascript">
	$(function() {
		$(".gallery").fancybox({
			'type' : 'image'
		});
	});
</script>
@endpush
