<?php

namespace App\Services;

use App\Models\Barang;
use App\Models\DetailPembelian;
use App\Models\Pembelian;
use Exception;
use Illuminate\Support\Facades\DB;

class PembelianService
{
	public function createPembelian(array $id_barang, array $jumlah): Pembelian
	{
		if (count($id_barang) != count($jumlah)) {
			throw new Exception("Invalid input!");
		}

		$total_harga = 0;

		$pembelian = new Pembelian();
		$semua_detail_pembelian = [];

		for ($i = 0; $i < count($id_barang); $i++) {
			$id = $id_barang[$i];
			$jumlah_dibeli = $jumlah[$i];

			$barang = Barang::findOrFail($id);

			if ($jumlah_dibeli > $barang->stok) {
				throw new Exception("Jumlah pembelian $barang->nama ($jumlah_dibeli) melebihi stok: $barang->stok");
			}

			$subtotal = $barang->harga * $jumlah_dibeli;

			$detail_pembelian = new DetailPembelian();
			$detail_pembelian->fill([
				'id_barang' => $barang->id,
				'jumlah' => $jumlah_dibeli,
				'subtotal' => $subtotal,
			]);

			array_push($semua_detail_pembelian, $detail_pembelian);
			$total_harga += $subtotal;
		}

		$diskon_persen = 0;
		$diskon_nominal = 0;

		# Rumus yang digunakan: Apabila harga > 100000 diskon 10%
		if ($total_harga > 100000) {
			$diskon_persen = 10;
			$diskon_nominal = $total_harga * ($diskon_persen / 100);
		}

		$pembelian->total_harga = $total_harga;
		$pembelian->diskon_persen = $diskon_persen;
		$pembelian->diskon_nominal = $diskon_nominal;

		DB::transaction(function () use ($pembelian, $semua_detail_pembelian) {
			# Simpan pembelian dahulu
			$pembelian->save();

			foreach ($semua_detail_pembelian as $s) {
				# Simpan detail pembelian
				$s->id_pembelian = $pembelian->id;
				$s->save();

				# Kurangi stok
				$barang = Barang::findOrFail($s->id_barang);
				$barang->stok -= $s->jumlah;
				$barang->save();
			}
		});
		
		return $pembelian;
	}
}
