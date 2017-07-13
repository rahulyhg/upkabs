<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- SEO -->
	<meta name="description" itemprop="description" content="The place of informations. Stay say UpKabs. UpKabs create link between people and informations" />
	<!-- Favicon -->
	<link rel="shortcut icon" type="image/png" href="{{ asset('img/icon/upkabs-icon.png') }}"/>

	<title>@yield('title')</title>

	<base href="{{ url('') }}">
	
	<!-- Scripts -->
	<script>
		window.Laravel = <?php echo json_encode([
			'csrfToken' => csrf_token(),
			'url' => config('app.url'),
		]); ?>
	</script>

	<!-- Styles -->
	@include('links.style')

	@stack('styles')
</head>
<body>

	<!-- CSRF TOKEN -->
	{{ csrf_field() }}

	<!-- User Id -->
	<span user-id="{{ Session::get('id') }}" id="user-id"></span>

	@yield('content')

	<!-- Footer -->
	{{-- @yield('footer') --}}

	<!-- Scripts -->
	@include('links.scripts')
	@stack('scripts')
</body>
</html>
