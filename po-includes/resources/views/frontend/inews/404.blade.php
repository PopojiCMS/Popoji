@extends(getTheme('layouts.app'))

@section('content')
	<div class="page-title">&nbsp;</div>
	
	<div class="container">
		<div class="row row-m">
			<div class="col-sm-8 col-p main-content">
				<div class="theiaStickySidebar">
					<div class="post-inner">
						<div class="post-body text-center">
							<div class="typography-content">
								<h1>404</h1>
								<h3>Page Not Found</h3>
								<p style="margin:30px auto;">Unfortunately the content you’re looking for isn’t here. There may be a misspelling in your web address or you may have clicked a link for content that no longer exists. Perhaps you would be interested in our most recent articles.</p>
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
