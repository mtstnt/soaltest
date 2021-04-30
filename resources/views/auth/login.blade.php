@extends('layout.base')

@section('content')

<div class="container-fluid p-0 bg-dark vh-100 d-flex justify-content-center align-items-center">
	<div class="col-12 col-sm-6 p-5 bg-light text-dark rounded">
		@include('layout.flash')
		<h1 class="display-4">Log in</h1>
		<form action="{{ route("auth.check_login") }}" method="POST">
			@csrf
			<div class="mb-3">
				<label class="my-2" for="username">Username</label>
				<input class="form-control" type="text" name="username" id="username">
				@error('username')
				<small class="text-danger">{{ $message }}</small>
				@enderror
			</div>
			<div class="mb-3">
				<label class="my-2" for="password">Password</label>
				<input class="form-control" type="password" name="password" id="password">
				@error('password')
				<small class="text-danger">{{ $message }}</small>
				@enderror
			</div>
			<input class="btn btn-primary" type="submit" value="Submit">
		</form>
	</div>
</div>

@endsection