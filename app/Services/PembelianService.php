<?php 

namespace App\Services;

use App\Models\Barang;
use App\Models\Pembelian;
use Exception;

class PembelianService
{
	public function calculatePembelian(int $jumlah_pembelian, Barang $barang): Pembelian
	{
		if ($jumlah_pembelian < $barang->stok) {
			throw new Exception("Jumlah pembelian melebihi stok!");
		}

		$total_harga = $barang->harga * $jumlah_pembelian;
		$diskon_nominal = 0;
		$diskon_persen = 0;

		# Rumus yang digunakan: Apabila harga > 100000 diskon 10%
		if ($total_harga > 100000) {
			$diskon_persen = 20;
			$diskon_nominal = $total_harga * ($diskon_persen / 100);
		}

		$pembelian = new Pembelian();
		$pembelian->id_barang = $barang->id;
		$pembelian->jumlah = $jumlah_pembelian;
		$pembelian->diskon_persen = $diskon_persen;
		$pembelian->diskon_nominal = $diskon_nominal;
		$pembelian->total_harga = $total_harga;
		return $pembelian;
	}
}