<li>
	<div class="comment-main-level">
		<div class="comment-avatar"><img src="{{ asset('po-admin/assets/img/avatar.jpg') }}" alt=""></div>
		<div class="comment-box">
			<div class="comment-content">
				<div class="comment-header"> <cite class="comment-author">{{ $comment->name }}</cite>
					<time datetime="{{ date('yyyy-mm-dd', strtotime($comment->created_at)) }}" class="comment-datetime">{{ date('d F Y', strtotime($comment->created_at)) }}</time>
				</div>
				<p>{{ strip_tags($comment->content) }}</p>
				<a href="javascript:void(0);" class="btn btn-news po-reply" id="{{ $comment->id }}">Reply</a>
			</div>
		</div>
	</div>
	
	@if (count($comment->children) > 0)
		<ul class="comments-list reply-list">
			@foreach($comment->children as $comment)
				@include(getTheme('partials.subcomment'), $comment)
			@endforeach
		</ul>
	@endif
</li>
