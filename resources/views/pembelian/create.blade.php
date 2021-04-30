@extends('layout.page')

@section('page.content')
<section class="col-sm-6 col-12 mx-auto my-2">
	@include('layout.flash')
	@include('layout.errors')
	<h1 class="text-center">Tambah Pembelian</h1>
	<form action="{{ route("pembelian.store") }}" method="POST">
		@csrf
		<label for="count">Jumlah macam barang:</label>
		<input class="form-control mb-3" type="number" name="count" id="count" onchange="onCountChange()">

		<div class="input-barang">
		</div>

		<input class="btn btn-primary mt-3" type="submit" value="Submit">
	</form>
</section>

<script>
	const inputBarangElement = document.querySelector(".input-barang");
	
	function onCountChange()
	{
		const count = document.getElementById("count").value;
		let str = "";
		for (let i = 0; i < count; i++) {
			inputBarangElement.innerHTML += `
			<div class="border p-1 mb-3">
				<div class="mb-1">
					<label class="my-2" for="id_barang">Barang ke-${i + 1}</label>
					<select class="form-control" name="id_barang[]">
						<option value="-1" selected>Choose...</option>
						@foreach ($list_barang as $b)
							<option value="{{ $b->id }}">{{ $b->nama }}</option>
						@endforeach
					</select>
				</div>
				<div class="mb-1">
					<label class="my-2" for="jumlah">Jumlah</label>
					<input class="form-control" type="number" min="0" name="jumlah[]">
				</div>
			</div>`;
		}
	}

</script>
@endsection