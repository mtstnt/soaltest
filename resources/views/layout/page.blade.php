@extends('layout.base')

@section('content')
<div class="container-fluid p-0">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<a class="navbar-brand" href="/">Admin</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
				data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
				aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link {{ $page === "index" ? "active" : "" }}" aria-current="page" href="/">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link {{ $page === "barang" ? "active" : "" }}" aria-current="page" href="/barang">Barang</a>
					</li>
					<li class="nav-item">
						<a class="nav-link {{ $page === "transaksi" ? "active" : "" }}" aria-current="page" href="/transaksi">Transaksi</a>
					</li>
				</ul>
				<a class="btn btn-danger" href="/logout">Log out</a>
				
			</div>
		</div>
	</nav>

	@yield('page.content')
</div>
@endsection