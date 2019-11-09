@extends(getTheme('layouts.app'))

@section('content')
	<div class="page-title">&nbsp;</div>
	
	<div class="container">
		<div class="row row-m">
			<div class="col-sm-8 main-content col-p">
				<div class="theiaStickySidebar">
					<div class="contact_form_inner">
						<div class="panel_inner">
							<div class="panel_header">
								<h4><strong>We'd Love to Here</strong> Form you, Get in Touch With in Us?</h4>
							</div>
							<div class="panel_body">
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
								
								<form class="comment-form" action="{{ url('contact/send') }}" method="post">
									{{ csrf_field() }}
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="name">Full Name *</label>
												<input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Your name *">
											</div>
										</div>
										<div class="col-sm-6">
											<label for="email">Email *</label>
											<div class="form-group">
												<input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Your email address here *">
											</div>
										</div>
										<div class="col-sm-12">
											<label for="subject">Subject *</label>
											<div class="form-group">
												<input type="text" class="form-control" id="subject" name="subject" value="{{ old('subject') }}" placeholder="Write subject here *">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="message">Message *</label>
										<textarea class="form-control" id="message" name="message" placeholder="Your Comment *" rows="5">{{ old('message') }}</textarea>
									</div>
									<div class="form-group">
										{!! NoCaptcha::display() !!}
									</div>
									<button type="submit" class="btn btn-news">Submit</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-4 rightSidebar col-p">
				<div class="theiaStickySidebar">
					<div class="panel_inner">
						<div class="panel_header">
							<h4><strong>Contact</strong> Info</h4>
						</div>
						<div class="panel_body">
							<address>
								<strong>{{ getSetting('web_name') }}</strong><br><br>
								{{ getSetting('address') }}<br><br>
								<abbr title="Email">Email:</abbr> {{ getSetting('email') }}<br>
								<abbr title="Phone">Phone:</abbr> {{ getSetting('telephone') }}<br>
								<abbr title="Fax">Fax:</abbr> {{ getSetting('fax') }}
							</address>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
@endsection
