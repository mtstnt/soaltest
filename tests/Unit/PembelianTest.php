<?php

namespace Tests\Unit;

use App\Models\Barang;
use App\Models\Pembelian;
use App\Services\PembelianService;
use Exception;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PembelianTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function buatBarang()
    {
        Barang::create([
            'id' => "ABC1",
            'nama' => "A",
            'harga' => 100000,
            'stok' => 40,
        ]);

        Barang::create([
            'id' => "ABC2",
            'nama' => "B",
            'harga' => 15000,
            'stok' => 20,
        ]);

        Barang::create([
            'id' => "ABC3",
            'nama' => "C",
            'harga' => 200000,
            'stok' => 10,
        ]);
    }

    public function test_pembelian_1_barang()
    {
        $this->buatBarang();

        $pembelianService = (new PembelianService())
            ->createPembelian([
                "ABC1"
            ], [
                5
            ]);

        # Test total harga
        $this->assertTrue($pembelianService->total_harga === 5 * 100000);

        # Test stok barang berkurang
        $b = Barang::find("ABC1");
        $this->assertTrue($b->stok == 40 - 5);
    }

    public function test_pembelian_1_barang_melebihi_stok()
    {
        $this->buatBarang();

        $this->expectException(Exception::class);
        $pembelianService = (new PembelianService())
            ->createPembelian([
                "ABC1"
            ], [
                500
            ]);

        $this->assertDatabaseMissing("pembelian", [
            'total_harga' => 500 * Barang::find("ABC1")->harga
        ]);
    }
    
    public function test_pembelian_banyak_barang()
    {
        $this->buatBarang();

        $pembelianService = (new PembelianService())
            ->createPembelian([
                "ABC1", "ABC2", "ABC3"
            ], [
                5, 6, 7
            ]);

        $this->assertTrue(Barang::find("ABC1")->stok === 40 - 5);
        $this->assertTrue(Barang::find("ABC2")->stok === 20 - 6);
        $this->assertTrue(Barang::find("ABC3")->stok === 10 - 7);
    }

    public function test_pembelian_nol_barang()
    {
        $this->buatBarang();

        $pembelianService = (new PembelianService())
            ->createPembelian([], []);
    }
}
