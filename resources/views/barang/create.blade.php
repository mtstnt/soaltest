@extends('layout.page')

@section('page.content')
<section class="col-sm-6 col-12 mx-auto my-2">
	@include('layout.flash')
	<h1 class="text-center">Tambah Barang</h1>
	<form action="{{ route("barang.store") }}" method="POST">
		@csrf
		<div class="mb-3">
			<label class="my-2" for="id">ID</label>
			<input class="form-control" type="text" name="id" id="id">
			@error('id')
			<small class="text-danger">{{ $message }}</small>
			@enderror
		</div>
		<div class="mb-3">
			<label class="my-2" for="nama">Nama Barang</label>
			<input class="form-control" type="text" name="nama" id="nama">
			@error('nama')
			<small class="text-danger">{{ $message }}</small>
			@enderror
		</div>
		<div class="mb-3">
			<label class="my-2" for="harga">Harga</label>
			<input class="form-control" type="number" min="0" name="harga" id="harga">
			@error('harga')
			<small class="text-danger">{{ $message }}</small>
			@enderror
		</div>
		<div class="mb-3">
			<label class="my-2" for="stok">Stok</label>
			<input class="form-control" type="number" min="0" name="stok" id="stok">
			@error('stok')
			<small class="text-danger">{{ $message }}</small>
			@enderror
		</div>
		<input class="btn btn-primary" type="submit" value="Submit">
	</form>
</section>
@endsection