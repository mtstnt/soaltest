<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allBarang = Barang::all();

        return view("barang.index", [
            'title' => "Admin: Master Barang",
            'list_barang' => $allBarang,
            'co' => 1,
            'page' => 'barang',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("barang.create", [
            "title" => "Admin: Menambahkan Barang",
            "page" => "barang"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'id' => 'required|unique:master_barang,id|max:50',
            'nama' => 'required|max:150',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        if (!Barang::create($requestData)) {
            return redirect()->route('barang.create')->with("err", "Penambahan gagal!");
        }

        return redirect()->route('barang.index')->with("success", "Penambahan barang berhasil!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $barang = Barang::findOrFail($id);

            return view("barang.view", [
                "title" => "Admin: " . $barang->id,
                "barang" => $barang,
                "page" => "barang",
            ]);
        } catch (ModelNotFoundException $e) {
            return redirect()->route("barang.index")->with("err", "Model with ID " . $id . " not found!");
        } catch (Exception $e) {
            return redirect()->route("barang.index")->with("err", "Error: " . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $barang = Barang::findOrFail($id);

            return view("barang.edit", [
                "title" => "Admin: Edit Barang",
                "barang" => $barang,
                "page" => "barang",
            ]);
        } catch (ModelNotFoundException $e) {
            return redirect()->route("barang.index")->with("err", "Model with ID " . $id . " not found!");
        } catch (Exception $e) {
            return redirect()->route("barang.index")->with("err", "Error: " . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $barang = Barang::findOrFail($id);

            $new_data = $request->validate([
                'id' => 'exclude_if:id,' . $barang->id . '|required|max:50',
                'nama' => 'required|max:150',
                'harga' => 'required|numeric',
                'stok' => 'required|numeric',
            ]);

            if (array_key_exists("id", $new_data))
                $barang->id = $new_data["id"];

            $barang->nama = $new_data["nama"];
            $barang->harga = $new_data["harga"];
            $barang->stok = $new_data["stok"];

            if (!$barang->update()) {
                throw new Exception("Gagal mengupdate data barang!");
            }

            return redirect()->route("barang.index")->with("success", "Barang berhasil terupdate!");
        } catch (ModelNotFoundException $e) {
            return redirect()->route("barang.index")->with("err", "Model with ID " . $id . " not found!");
        } catch (Exception $e) {
            return redirect()->route("barang.index")->with("err", "Error: " . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $barang = Barang::findOrFail($id);
            
            if (! $barang->delete()) {
                throw new Exception("Gagal menghapus data barang!");
            }

            return redirect()->route("barang.index")->with("success", "Barang berhasil terhapus!");

        } catch (ModelNotFoundException $e) {
            return redirect()->route("barang.index")->with("err", "Model with ID " . $id . " not found!");
        } catch (Exception $e) {
            return redirect()->route("barang.index")->with("err", "Error: " . $e->getMessage());
        }
    }
}
