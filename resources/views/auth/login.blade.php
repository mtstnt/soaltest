@extends('layout.base')

@section('content')
	
	<div class="container">
		<div class="col-12 col-sm-6 mx-auto">
			<h1>Log in</h1>	
			<form action="{{ route("auth.check_login") }}">
				<label for="username">Username</label>
				<input class="form-control" type="text" name="username" id="username">
				<label for="password">Password</label>
				<input  class="form-control" type="text" name="password" id="password">
				<input class="btn btn-primary" type="submit" value="Submit">
			</form>
		</div>	
	</div>

@endsection