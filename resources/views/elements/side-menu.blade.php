<div class="sidenav">
	<span href="javascript:void(0)" class="closebtn" id="close-side-nav"><i class="fa fa-times"></i></span>
	<a href="{{ url('profile') }}">
		<div>
			<img src="{{ Session::get('avatar') }}" alt="{{ Session::get('name') }}"> 
		</div>
		<div>			
			<center>{{ Session::get('name') }}</center>
		</div>
	</a>
	<a href="{{ url('timeline') }}">Timeline</a>
	<a href="{{ url('connection') }}">Connection</a>
	<a href="{{ url('trending') }}">Trending 10</a>
	{{-- <a href="{{ url('file') }}">My File</a> --}}
	<a href="auth/signout">Sign Out</a>
</div>