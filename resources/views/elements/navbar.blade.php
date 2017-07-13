<nav class="navbar navbar-fixed-top">
	<div class="container-fluid">
		<button class="navbar-toggle navbar-menu" id="open-side-nav">
			<i class="fa fa-bars"></i>
		</button>
		<a href="{{ url('timeline') }}" id="back-to-timeline" class="navbar-toggle navbar-menu hide"><i class="fa fa-arrow-left"></i></a>
		<div class="navbar-text pull-right">
			<a href="{{ url('notification') }}" class="badge notification-badge" id="count-notification"></a>
		</div>
		<a class="navbar-logo" href="timeline">
			<img src="{{ asset('img/logo/incom-logo-white.png') }}" alt="Incom">
		</a>
	</div>
	<div class="container text-center mark mark-loader" id="loader" hidden>
		Loading...
	</div>
	<div class="container text-center mark mark-error" id="error-info" hidden>
		Error
	</div>
</nav>
