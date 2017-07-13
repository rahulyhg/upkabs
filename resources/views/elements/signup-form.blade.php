<form class="form-group" action="{{ url('auth/signup') }}" method="post">
	<!-- CSRF TOKEN -->
    	{{ csrf_field() }}
    
	<div class="form-group">
		<input type="email" class="form-control" placeholder="Email" name="email_">
	</div>
	<button type="submit" class="btn btn-blue btn-block">Sign Up</button>
</form>