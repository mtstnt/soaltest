@extends('layout.page')

@section('page.content')
<section class="col-sm-8 col-12 mx-auto my-2">
	@include('layout.flash')
	<h1 class="text-center mb-3">View Pembelian</h1>

	<div class="col-12 col-sm-8 mx-auto text-center">
		<div class="row my-3">
			<div class="col-6">ID: </div>
			<div class="col-6">{{ $pembelian->total_harga }}</div>
		</div>

		<div class="row my-3">
			<div class="col-6">Diskon (Nominal) </div>
			<div class="col-6">{{ $pembelian->diskon_nominal }}</div>
		</div>

		<div class="row my-3">
			<div class="col-6">Diskon(Persentase): </div>
			<div class="col-6">{{ $pembelian->diskon_persen }}</div>
		</div>

		<div class="row my-3">
			<div class="col-6">Tanggal/Waktu: </div>
			<div class="col-6">{{ date("d-m-Y H:i:s", strtotime($pembelian->created_at)) }}</div>
		</div>

		<table class="table mt-3">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">ID Barang</th>
					<th scope="col">Nama Barang</th>
					<th scope="col">Jumlah</th>
					<th scope="col">Subtotal</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($pembelian->detail as $p)
					<tr>
						<th class="align-middle" scope="row">{{ $co++ }}.</th>
						<td class="align-middle">{{ $p->barang->id }}</td>
						<td class="align-middle">{{ $p->barang->nama }}</td>
						<td class="align-middle">{{ $p->jumlah }}</td>
						<td class="align-middle">{{ $p->subtotal }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<a class="btn btn-danger" href="/pembelian">Back</a>
	</div>

</section>
@endsection