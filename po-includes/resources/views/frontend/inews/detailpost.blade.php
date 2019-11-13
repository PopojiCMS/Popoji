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
							
							{!! $post->content !!}
						</div>
						
						@if($post->type == 'pagination')
							<div class="post-footer"> 
								<div class="row thm-margin">
									<div class="col-xs-12 col-sm-12 col-md-12 thm-padding">
										<ul class="pagination">
											<li class="disabled"><span class="ti-angle-left"></span></li>
											<li class="active"><span>1</span></li>
											<li><a href="#">2</a></li>
											<li><a href="#">3</a></li>
											<li class="disabled"><span class="extend">...</span></li><li>
											</li><li><a href="#">12</a></li>
											<li><a href="#"><i class="ti-angle-right"></i></a></li>
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
															<a href="{{ url('detailpost/'.$relatedPost->seotitle) }}">
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
														<h5><a href="{{ url('detailpost/'.$relatedPost->seotitle) }}" class="title">{{ $relatedPost->title }}</a></h5>
														<ul class="authar-info">
															<li>{{ date('d F Y', strtotime($relatedPost->created_at)) }}</li>
															<li class="hidden-sm"><a href="{{ url('detailpost/'.$relatedPost->seotitle) }}" class="link">{{ $relatedPost->hits }} Views</a></li>
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
															<a href="{{ url('detailpost/'.$relatedPost2->seotitle) }}">
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
														<h5><a href="{{ url('detailpost/'.$relatedPost2->seotitle) }}" class="title">{{ $relatedPost2->title }}</a></h5>
														<ul class="authar-info">
															<li>{{ date('d F Y', strtotime($relatedPost2->created_at)) }}</li>
															<li class="hidden-sm"><a href="{{ url('detailpost/'.$relatedPost2->seotitle) }}" class="link">{{ $relatedPost2->hits }} Views</a></li>
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
					
					
					
					<form class="comment-form" action="{{ url('comment/send/'.$post->seotitle) }}" method="post">
						{{ csrf_field() }}
						<input type="hidden" name="parent" value="{{ old('parent') == null ? 0 : old('parent') }}" />
						<input type="hidden" name="post_id" value="{{ $post->id }}" />
						<h3 id="comment-form"><strong>Leave</strong> a Comment</h3>
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
