<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPembelianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pembelian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_pembelian");
            $table->string("id_barang", 50);
            $table->unsignedInteger("jumlah");
            $table->unsignedInteger("subtotal");
            
            $table->foreign("id_barang")->references("id")->on("master_barang");
            $table->foreign("id_pembelian")->references("id")->on("pembelian");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pembelian');
    }
}
