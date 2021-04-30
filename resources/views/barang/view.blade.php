@extends('layout.page')

@section('page.content')
<section class="col-sm-8 mx-auto my-2">
	@include('layout.flash')
	<h1 class="text-center">View Barang {{ $barang->id }}</h1>

	<div class="col-4 mx-auto text-center">
		<div class="row my-3">
			<div class="col-12 col-sm-6">ID: </div>
			<div class="col-12 col-sm-6">{{ $barang->id }}</div>
		</div>

		<div class="row my-3">
			<div class="col-12 col-sm-6">Nama Barang: </div>
			<div class="col-12 col-sm-6">{{ $barang->nama }}</div>
		</div>

		<div class="row my-3">
			<div class="col-12 col-sm-6">Harga: </div>
			<div class="col-12 col-sm-6">{{ $barang->harga }}</div>
		</div>

		<div class="row my-3">
			<div class="col-12 col-sm-6">Stok: </div>
			<div class="col-12 col-sm-6">{{ $barang->stok }}</div>
		</div>

		<a class="btn btn-warning" href="{{ route("barang.edit", $barang->id) }}">Edit</a>

		<form action="{{ route("barang.destroy", $barang->id) }}" method="POST" class="d-inline">
			@method("DELETE")
			@csrf
			<input onclick="confirm('Are you sure?')" type="submit" value="Delete" class="btn btn-danger">
		</form>
	</div>

</section>
@endsection