@extends(getTheme('layouts.app'))

@section('content')
	<div class="page-title">&nbsp;</div>
	
	<div class="container">
		<div class="row row-m">
			<div class="col-sm-8 col-p main-content">
				<div class="theiaStickySidebar">
					<div class="post_details_inner">
						<div class="post_details_block details_block2">
							<div class="post-header">
								<ul class="td-category">
									<li><a class="post-category" href="{{ url('category/'.$post->cseotitle) }}">{{ $post->ctitle }}</a></li>
								</ul>
								<h2>{{ $post->title }}</h2>
								<ul class="authar-info">
									<li><a href="javascript:void(0);" class="link">{{ $post->name }}</a></li>
									<li>{{ date('d F Y' , strtotime($post->created_at)) }}</li>
									<li><a href="javascript:void(0);" class="link">{{ $post->hits }} Views</a></li>
								</ul>
							</div>
							
							<div class="adaptive">
								@if($post->picture != '')
									<img src="{{ getPicture($post->picture, null, $post->updated_by) }}" class="img-responsive" alt="{{ $post->title }}" />
									<div class="caption-text">{{ $post->picture_description }}</div>
								@endif
							</div>
							
							{!! $content !!}
						</div>
						
						@if($post->type == 'pagination')
							<div class="post-footer"> 
								<div class="row thm-margin">
									<div class="col-xs-12 col-sm-12 col-md-12 thm-padding">
										<ul class="pagination">
											{!! postWithPagination($paginator, '<span class="ti-angle-left"></span>', '<span class="ti-angle-right"></span>') !!}
										</ul>
									</div>
								</div>
							</div>
						@endif
					</div>
					
					<div class="post-inner post-inner-2">
						<div class="post-head">
							<h2 class="title"><strong>Related </strong> Posts</h2>
						</div>
						
						<div class="post-body">
							<div id="post-slider-2" class="owl-carousel owl-theme">
								<div class="item">
									<div class="news-grid-2">
										<div class="row row-margin">
											@foreach(relatedPost($post->id, $post->tag, 3, 0) as $relatedPost)
												<div class="col-xs-6 col-sm-4 col-md-4 col-padding">
													<div class="grid-item">
														<div class="grid-item-img">
															<a href="{{ prettyUrl($relatedPost) }}">
																<img src="{{ getPicture($relatedPost->picture, 'medium', $relatedPost->updated_by) }}" alt="" class="img-responsive">
																@if($relatedPost->type == 'picture')
																	<div class="link-icon">
																		<i class="fa fa-image"></i>
																	</div>
																@elseif($relatedPost->type == 'video')
																	<div class="link-icon">
																		<i class="fa fa-camera"></i>
																	</div>
																@endif
															</a>
														</div>
														<h5><a href="{{ prettyUrl($relatedPost) }}" class="title">{{ $relatedPost->title }}</a></h5>
														<ul class="authar-info">
															<li>{{ date('d F Y', strtotime($relatedPost->created_at)) }}</li>
															<li class="hidden-sm"><a href="{{ prettyUrl($relatedPost) }}" class="link">{{ $relatedPost->hits }} Views</a></li>
														</ul>
													</div>
												</div>
											@endforeach
										</div>
									</div>
								</div>
								
								<div class="item">
									<div class="news-grid-2">
										<div class="row row-margin">
											@foreach(relatedPost($post->id, $post->tag, 3, 3) as $relatedPost2)
												<div class="col-xs-6 col-sm-4 col-md-4 col-padding">
													<div class="grid-item">
														<div class="grid-item-img">
															<a href="{{ prettyUrl($relatedPost2) }}">
																<img src="{{ getPicture($relatedPost2->picture, 'medium', $relatedPost2->updated_by) }}" alt="" class="img-responsive">
																@if($relatedPost2->type == 'picture')
																	<div class="link-icon">
																		<i class="fa fa-image"></i>
																	</div>
																@elseif($relatedPost2->type == 'video')
																	<div class="link-icon">
																		<i class="fa fa-camera"></i>
																	</div>
																@endif
															</a>
														</div>
														<h5><a href="{{ prettyUrl($relatedPost2) }}" class="title">{{ $relatedPost2->title }}</a></h5>
														<ul class="authar-info">
															<li>{{ date('d F Y', strtotime($relatedPost2->created_at)) }}</li>
															<li class="hidden-sm"><a href="{{ prettyUrl($relatedPost2) }}" class="link">{{ $relatedPost2->hits }} Views</a></li>
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
					
					@if(getSetting('comment') == 'Y')
						<div class="comments-container">
							<h3>Comments ({{ $post->comments_count }})</h3>
							@if($post->comments_count > 0)
								<ul class="comments-list">
									@each(getTheme('partials.comment'), getComments($post->id, 5), 'comment', getTheme('partials.comment'))
								</ul>
								
								<div class="post-footer"> 
									<div class="row thm-margin">
										<div class="col-xs-12 col-sm-12 col-md-12 thm-padding">
											{{ getComments($post->id, 5)->links() }}
										</div>
									</div>
								</div>
							@else
								<p class="text-center">There are no comments yet</p>
							@endif
						</div>
					@endif
					
					<form class="comment-form" id="comment-form" action="{{ url('comment/send/'.$post->seotitle) }}" method="post">
						{{ csrf_field() }}
						<input type="hidden" name="parent" id="parent" value="{{ old('parent') == null ? 0 : old('parent') }}" />
						<input type="hidden" name="post_id" id="post_id" value="{{ $post->id }}" />
						<h3><strong>Leave</strong> a Comment</h3>
						<div class="row">
							<div class="col-sm-12">
								@if (Session::has('flash_message'))
									<div class="alert alert-success">{{ Session::get('flash_message') }}</div>
								@endif
								
								@if ($errors->any())
									<div class="alert alert-danger">
										<ul>
											@foreach ($errors->all() as $error)
												<li>{{ $error }}</li>
											@endforeach
										</ul>
									</div>
								@endif
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="name">Name *</label>
									<input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Your name *">
								</div>
							</div>
							<div class="col-sm-6">
								<label for="email">Email *</label>
								<div class="form-group">
									<input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Your email address here">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="content">Comment *</label>
							<textarea class="form-control" id="content" name="content" placeholder="Your Comment *" rows="5">{{ old('content') }}</textarea>
						</div>
						<div class="form-group">
							{!! NoCaptcha::display() !!}
						</div>
						<button type="submit" class="btn btn-news">Submit</button>
					</form>
				</div>
			</div>
			
			<div class="col-sm-4 col-p rightSidebar">
				@include(getTheme('partials.sidebar'))
			</div>
		</div>
	</div>
@endsection

@push('scripts')
<script type="text/javascript">
	$(function() {
		$('.po-reply').on('click', function() {
			var id = $(this).attr('id');
			$('#comment-form #parent').val(id);
			
			$('html, body').animate({
				scrollTop: $("#comment-form").offset().top
			}, 1000);
		});
	});
</script>
@endpush
