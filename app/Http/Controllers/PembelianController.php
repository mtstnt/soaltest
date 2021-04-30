<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pembelian;
use App\Services\PembelianService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    public function index()
    {
        $list_pembelian = Pembelian::all();

        return view("pembelian.index", [
            "title" => "Admin: Pembelian",
            "page" => "pembelian",
            "list_pembelian" => $list_pembelian,
        ]);
    }

    public function create()
    {
        return view("pembelian.create", [
            "title" => "Admin: Tambah Pembelian",
            "page" => "pembelian",
        ]);
    }

    public function store(Request $request)
    {
        $new_data = $request->validate([
            "id_barang" => "required|max:50|exists:barang,id",
            "jumlah" => "required|numeric",
        ]);

        try {
            $barang = Barang::findOrFail($new_data["id_barang"]);

            $pembelian = (new PembelianService)->calculatePembelian($new_data['jumlah'], $barang);
            DB::transaction(function () use ($pembelian, $barang) {
                $pembelian->save();
                $barang->stok = $barang->stok - $pembelian->jumlah;
                $barang->update();
            });

            return redirect()->route("pembelian.index")->with("success", "Pembelian berhasil ditambahkan");
        } catch (ModelNotFoundException $e) {
            return redirect()->route("pembelian.create")->with("err", "Tidak ditemukan");
        } catch (Exception $e) {
            return redirect()->route("pembelian.create")->with("err", "Error: " . $e->getMessage());
        }
    }

    public function destroy($id)
    {
    }
}
