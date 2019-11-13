@extends(getTheme('layouts.app'))

@section('content')
	<div class="page-title">&nbsp;</div>
	
	<div class="container">
		<div class="row row-m">
			<div class="col-sm-8 col-p main-content">
				<div class="theiaStickySidebar">
					<div class="post-inner">
						<div class="post-head">
							@if($posts->total() > 0)
								<h2 class="title">Search : {{ $terms }} ({{ $posts->total() }})</h2>
							@else
								<h2 class="title">Search : {{ $terms }}</h2>
							@endif
						</div>
						
						<div class="post-body">
							@if($posts->total() > 0)
								@foreach($posts as $post)
									<div class="news-list-item articles-list">
										<div class="img-wrapper">
											<a href="{{ prettyUrl($post) }}" class="thumb"><img src="{{ getPicture($post->picture, 'medium', $post->updated_by) }}" alt="" class="img-responsive"></a>
										</div>
										<div class="post-info-2">
											<h4><a href="{{ prettyUrl($post) }}" class="title">{{ $post->title }}</a></h4>
											<ul class="authar-info">
												<li><i class="ti-timer"></i> {{ date('d F Y' , strtotime($post->created_at)) }}</li>
												<li><a href="{{ prettyUrl($post) }}" class="link"><i class="ti-eye"></i>{{ $post->hits }} Views</a></li>
											</ul>
											<p class="hidden-sm">{{ \Str::limit(strip_tags($post->content), 150) }}</p>
										</div>
									</div>
								@endforeach
							@else
								<div class="typography-content text-center">
									<h1>404</h1>
									<h3>Search Data Not Found</h3>
									<p style="margin:30px auto;">Unfortunately the content you’re looking for isn’t here. There may be a misspelling in your web address or you may have clicked a link for content that no longer exists. Perhaps you would be interested in our most recent articles.</p>
								</div>
							@endif
						</div>
						
						<div class="post-footer"> 
							<div class="row thm-margin">
								<div class="col-xs-12 col-sm-12 col-md-12 thm-padding">
									{{ $posts->links() }}
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
