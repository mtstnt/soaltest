@extends('layout.page')

@section('page.content')
<section class="col-sm-8 mx-auto my-2">
	@include('layout.flash')
	<h1 class="text-center">Master Barang</h1>
	<div class="my-2">
		<a class="btn btn-primary" href="{{ route('barang.create') }}">Add Barang</a>
	</div>
	<table class="table">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">ID Barang</th>
				<th scope="col">Nama Barang</th>
				<th scope="col">Harga</th>
				<th scope="col">Stok</th>
				<th scope="col">Perubahan Terakhir</th>
				<th scope="col">Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($list_barang as $b)
				<tr>
					<th class="align-middle" scope="row">{{ $co++ }}.</th>
					<td class="align-middle">{{ $b->id }}</td>
					<td class="align-middle">{{ $b->nama }}</td>
					<td class="align-middle">{{ $b->harga }}</td>
					<td class="align-middle">{{ $b->stok }}</td>
					<td class="align-middle">{{ $b->updated_at }}</td>
					<td class="align-middle">
						<a href="{{ route("barang.show", $b->id) }}" class="btn btn-secondary">View</a>

						<a class="btn btn-warning" href="{{ route('barang.edit', $b->id) }}">Edit</a>
						
						<form class="d-inline" onclick="confirm('Are you sure?')" action="{{ route("barang.destroy", $b->id) }}" method="POST">
							@method("DELETE")
							@csrf
							<input class="btn btn-danger" type="submit" value="Delete">
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</section>
@endsection