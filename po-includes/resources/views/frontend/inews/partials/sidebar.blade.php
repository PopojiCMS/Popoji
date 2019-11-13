<div class="theiaStickySidebar">
	<div class="add-inner">
		<img src="{{ asset('po-content/frontend/inews/images/add320x270-1.jpg') }}" class="img-responsive" alt="">
	</div>
	
	<div class="tabs-wrapper">
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#latest" aria-controls="latest" role="tab" data-toggle="tab">Latest Posts</a></li>
			<li role="presentation"><a href="#popular" aria-controls="popular" role="tab" data-toggle="tab">Popular Posts</a></li>
		</ul>
		
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane fade in active" id="latest">
				<div class="most-viewed">
					<ul id="most-today" class="content tabs-content">
						@php $nol = 1; @endphp
						@foreach(latestPost(5) as $latestPost)
							<li><span class="count">0{{ $nol }}</span><span class="text"><a href="{{ prettyUrl($latestPost) }}">{{ $latestPost->title }}</a></span></li>
							@php $nol++; @endphp
						@endforeach
					</ul>
				</div>
			</div>
			
			<div role="tabpanel" class="tab-pane fade" id="popular">
				<div class="popular-news">
					@php $nop = 1; @endphp
					@foreach(popularPost(5) as $popularPost)
						<div class="p-post">
							<h4><a href="{{ prettyUrl($popularPost) }}">{{ $popularPost->title }}</a></h4>
							<ul class="authar-info">
								<li><a href="{{ prettyUrl($popularPost) }}" class="link"><i class="ti-timer"></i> {{ date('d F Y' , strtotime($popularPost->created_at)) }}</a></li>
								<li><a href="{{ prettyUrl($popularPost) }}" class="link"><i class="ti-eye"></i>{{ $popularPost->hits }} Views</a></li>
							</ul>
						</div>
						@php $nop++; @endphp
					@endforeach
				</div>
			</div>
		</div>
	</div>
	
	<div class="panel_inner">
		<div class="panel_header">
			<h4><strong>Tags</strong></h4>
		</div>
		<div class="panel_body">
			<div class="tags-inner">
				@foreach(getTag(10) as $tag)
					<a href="{{ url('tag/'.$tag->seotitle) }}" class="ui tag">{{ $tag->title }}</a>
				@endforeach
			</div>
		</div>
	</div>
	
	<div class="archive-wrapper">
		<div id="datepicker"></div>
	</div>
</div>
