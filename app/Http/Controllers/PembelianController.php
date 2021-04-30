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
            "co" => 1,
        ]);
    }

    public function create()
    {
        return view("pembelian.create", [
            "title" => "Admin: Tambah Pembelian",
            "page" => "pembelian",
            "list_barang" => Barang::all()
        ]);
    }

    public function show($id)
    {
        try {
            $pembelian = Pembelian::findOrFail($id);

            return view("pembelian.view", [
                "title" => "Admin: Pembelian",
                "page" => "pembelian",
                "pembelian" => $pembelian,
                "co" => 1,
            ]);
        } catch (ModelNotFoundException $e) {
            return redirect()->route("pembelian.index")->with("err", "Tidak ditemukan!");
        } catch (Exception $e) {
            return redirect()->route("pembelian.index")->with("err", "Error: " . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $new_data = $request->validate([
            "count" => "required|numeric|min:1",
            "id_barang" => "required|array|min:1|exists:master_barang,id",
            "jumlah" => "required|array|min:1",
        ]);
            
        try {
            $pembelian = (new PembelianService)->createPembelian(
                $new_data["id_barang"],
                $new_data["jumlah"],
            );
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
