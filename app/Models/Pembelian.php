<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = "pembelian";
    protected $guarded = [];

    public function detail() {
        return $this->hasMany(DetailPembelian::class, "id_pembelian", "id");
    }
}
