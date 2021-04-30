<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    protected $table = "detail_pembelian";
    protected $guarded = [];

    public $timestamps = false;

    public function barang()
    {
        return $this->hasOne(Barang::class, "id", "id_barang");
    }
}
