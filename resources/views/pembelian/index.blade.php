@extends('layout.page')

@section('page.content')
<section class="col-sm-8 mx-auto my-2">
	@include('layout.flash')
	<h1 class="text-center">Catatan Pembelian</h1>
	<div class="my-2">
		<a class="btn btn-primary" href="{{ route('pembelian.create') }}">Tambah Pembelian</a>
	</div>
	<table class="table">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Diskon (persen)</th>
				<th scope="col">Diskon (nominal)</th>
				<th scope="col">Total Harga</th>
				<th scope="col">Perubahan Terakhir</th>
				<th scope="col">Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($list_pembelian as $p)
				<tr>
					<th class="align-middle" scope="row">{{ $co++ }}.</th>
					<td class="align-middle">{{ $p->diskon_persen }}</td>
					<td class="align-middle">{{ $p->diskon_nominal }}</td>
					<td class="align-middle">{{ $p->total_harga }}</td>
					<td class="align-middle">{{ $p->created_at }}</td>
					<td>
						<a class="btn btn-secondary" href="{{ route("pembelian.show", $p->id) }}">View</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</section>
@endsection