<div class="panel panel-default">
	<div class="panel-heading">
		<strong>{{ $post['title'] }}</strong><br/>
		<time class="timeago" datetime="{{ $post['date'] }}"></time> by 
		<a href="{{ url('connection/profile/'.$post['creator']) }}">{{ $post['name'] }}</a><br/>
		<span class="label label-default">{{ $post['category'] }}</span>
	</div>
	<div class="panel-body">
		<div class="thumbnail">
			@if ($post['type'] != 0)
			<img class="media-object post-image" src="{{ $post['media'] }}" alt="{{ $post['title'] }}">
			@else
			<img class="media-object post-image" src="{{ $media_url.$post['media'] }}" alt="{{ $post['title'] }}">
			@endif
		</div>
		<p>
			<!-- If Has Reference -->
			{{ $post['text'] }}
			@if (strlen($post['refrence']) > 0)
			<a href="{{ $post['refrence'] }}" target="_blank"><span class="label label-primary"><i class="fa fa-link"></i> visit the refrence</span></a>
			@endif
		</p>
		<!-- Action -->
		<div class="btn-group btn-group-justified" role="group">
			<span class="btn btn-default btn-sm" post-id="{{ $post['id'] }}">Comment</span>
			<span class="btn btn-default btn-sm" id="up-button">Up</span>
			<!-- Only The Post Owner For Delete Access -->
			@if (strcmp($whoami, $post['creator']) == 0)
			<span class="btn btn-default btn-sm" id="deactive-post-button" data-toggle="modal" data-target="#deactive-confirm-modal" post-id="{{ $post['id'] }}">Delete</span>
			@endif
		</div>
		<div class="label-action-post">
			<span class="label label-default"><span id="comment-number">Loading...</span></span>
			<span class="label label-default"><span id="up-number">Loading...</span></span>
		</div>
	</div>

	@include('elements.create-comment-form')
	@include('elements.loader')

	<!-- Comments -->
	<div id="comments">
		<!-- DOM -->
	</div>

	<!-- Delete Confirmation -->
	@include('elements.deactive-confirm')
</div>
