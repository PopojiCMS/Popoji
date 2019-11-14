@extends(getTheme('layouts.app'))

@section('content')
	<div class="container">
		<div class="newstricker_inner">
			<div class="trending"><strong>Trending</strong> Now</div>
			<div id="NewsTicker" class="owl-carousel owl-theme">
				@foreach(trendingPost(5) as $trendingPost)
					<div class="item">
						<a href="{{ prettyUrl($trendingPost) }}">{{ $trendingPost->title }}</a>
					</div>
				@endforeach
			</div>
		</div>
	</div>
	
	<section class="slider-inner">
		<div class="container">
			<div class="row thm-margin">
				<div class="col-xs-12 col-sm-8 col-md-8 thm-padding">
					<div class="slider-wrapper">
						<div id="owl-slider" class="owl-carousel owl-theme">
							@foreach(headlinePost(3, 0) as $headlinePost)
								<div class="item">
									<div class="slider-post post-height-1">
										<a href="{{ prettyUrl($headlinePost) }}" class="news-image"><img src="{{ getPicture($headlinePost->picture, 'original', $headlinePost->updated_by) }}" alt="" class="img-responsive"></a>
										<div class="post-text">
											<span class="post-category">{{ $headlinePost->ctitle }}</span>
											<h2><a href="{{ prettyUrl($headlinePost) }}">{{ $headlinePost->title }}</a></h2>
											<ul class="authar-info">
												<li class="authar"><a href="{{ prettyUrl($headlinePost) }}">{{ $headlinePost->name }}</a></li>
												<li class="date">{{ date('d F Y' , strtotime($headlinePost->created_at)) }}</li>
												<li class="view"><a href="{{ prettyUrl($headlinePost) }}">{{ $headlinePost->hits }} Views</a></li>
											</ul>
										</div>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4 thm-padding">
					<div class="row slider-right-post thm-margin">
						@foreach(headlinePost(2, 3) as $headlinePost2)
							<div class="col-xs-6 col-sm-12 col-md-12 thm-padding">
								<div class="slider-post post-height-2">
									<a href="{{ prettyUrl($headlinePost2) }}" class="news-image"><img src="{{ getPicture($headlinePost2->picture, 'medium', $headlinePost2->updated_by) }}" alt="" class="img-responsive"></a>
									<div class="post-text">
										<span class="post-category">{{ $headlinePost2->ctitle }}</span>
										<h4><a href="{{ prettyUrl($headlinePost2) }}">{{ $headlinePost2->title }}</a></h4>
										<ul class="authar-info">
											<li class="authar hidden-xs hidden-sm"><a href="{{ prettyUrl($headlinePost2) }}">{{ $headlinePost2->name }}</a></li>
											<li class="hidden-xs">{{ date('d F Y' , strtotime($headlinePost2->created_at)) }}</li>
											<li class="view hidden-xs hidden-sm"><a href="{{ prettyUrl($headlinePost2) }}">{{ $headlinePost2->hits }} Views</a></li>
										</ul>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<div class="container">
		<div class="row row-m">
			<div class="col-sm-8 col-p main-content">
				<div class="theiaStickySidebar">
					<div class="post-inner">
						<div class="post-head">
							<h2 class="title"><strong>Popular</strong> Posts</h2>
						</div>
						
						<div class="post-body">
							<div id="post-slider" class="owl-carousel owl-theme">
								<div class="item">
									<div class="row">
										<div class="col-sm-6 main-post-inner bord-right">
											@foreach(popularPost(1, 0) as $popularPost)
												<article>
													<figure>
														<a href="{{ prettyUrl($popularPost) }}"><img src="{{ getPicture($popularPost->picture, 'medium', $popularPost->updated_by) }}" height="242" width="345" alt="" class="img-responsive"></a>
														<span class="post-category">{{ $popularPost->ctitle }}</span>
													</figure>
													<div class="post-info">
														<h3><a href="{{ prettyUrl($popularPost) }}">{{ $popularPost->title }}</a></h3>
														<ul class="authar-info">
															<li><i class="ti-timer"></i> {{ date('d F Y' , strtotime($popularPost->created_at)) }}</li>
															<li class="like"><a href="{{ prettyUrl($popularPost) }}"><i class="ti-eye"></i> {{ $popularPost->hits }} Views</a></li>
														</ul>
														<p>{{ \Str::limit(strip_tags($popularPost->content), 250) }}</p>
													</div>
												</article>
											@endforeach
										</div>
										
										<div class="col-sm-6">
											<div class="news-list">
												@foreach(popularPost(4, 1) as $popularPost2)
													<div class="news-list-item">
														<div class="img-wrapper">
															<a href="{{ prettyUrl($popularPost2) }}" class="thumb">
																<img src="{{ getPicture($popularPost2->picture, 'medium', $popularPost2->updated_by) }}" alt="" class="img-responsive">
																@if($popularPost2->type == 'picture')
																	<div class="link-icon">
																		<i class="fa fa-image"></i>
																	</div>
																@elseif($popularPost2->type == 'video')
																	<div class="link-icon">
																		<i class="fa fa-camera"></i>
																	</div>
																@endif
															</a>
														</div>
														<div class="post-info-2">
															<h5><a href="{{ prettyUrl($popularPost2) }}" class="title">{{ $popularPost2->title }}</a></h5>
															<ul class="authar-info">
																<li><i class="ti-timer"></i> {{ date('d F Y' , strtotime($popularPost2->created_at)) }}</li>
																<li class="like hidden-xs hidden-sm"><a href="{{ prettyUrl($popularPost2) }}"><i class="ti-eye"></i> {{ $popularPost2->hits }} Views</a></li>
															</ul>
														</div>
													</div>
												@endforeach
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="add-inner">
						<img src="{{ asset('po-content/frontend/inews/images/add728x90-1.jpg') }}" class="img-responsive" alt="">
					</div>
					
					<div class="post-inner">
						<div class="post-head">
							<h2 class="title"><strong>Latest</strong> Posts</h2>
						</div>
						
						<div class="post-body">
							@foreach(latestPostWithPaging(5) as $latestPost)
								<div class="news-list-item articles-list">
									<div class="img-wrapper">
										<a href="{{ prettyUrl($latestPost) }}" class="thumb"><img src="{{ getPicture($latestPost->picture, 'medium', $latestPost->updated_by) }}" alt="" class="img-responsive"></a>
									</div>
									<div class="post-info-2">
										<h4><a href="{{ prettyUrl($latestPost) }}" class="title">{{ $latestPost->title }}</a></h4>
										<ul class="authar-info">
											<li><i class="ti-timer"></i> {{ date('d F Y' , strtotime($latestPost->created_at)) }}</li>
											<li class="like"><a href="{{ prettyUrl($latestPost) }}"><i class="ti-eye"></i> {{ $latestPost->hits }} Views</a></li>
										</ul>
										<p class="hidden-sm">{{ \Str::limit(strip_tags($popularPost->content), 250) }}</p>
									</div>
								</div>
							@endforeach
						</div>
						
						<div class="post-footer"> 
							<div class="row thm-margin">
								<div class="col-md-12 thm-padding">
									{{ latestPostWithPaging(5)->links() }}
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
	
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="featured-inner">
					<div id="featured-owl" class="owl-carousel">
						@foreach(latestGallery(8) as $latestGallery)
							<div class="item">
								<div class="featured-post">
									<a href="{{ url('album/'.$latestGallery->aseotitle) }}" class="news-image"><img src="{{ getPicture($latestGallery->picture, 'medium', $latestGallery->updated_by) }}" alt="" class="img-responsive"></a>
									<div class="post-text">
										<span class="post-category">{{ $latestGallery->atitle }}</span>
										<h4>{{ $latestGallery->title }}</h4>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
