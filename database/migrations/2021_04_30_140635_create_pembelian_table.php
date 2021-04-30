<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian', function (Blueprint $table) {
            $table->id();
            $table->string("id_barang", 50);
            $table->unsignedInteger("jumlah");
            $table->unsignedInteger("diskon_persen");
            $table->unsignedInteger("diskon_nominal");
            $table->unsignedInteger("total_harga");
            $table->timestamps();

            $table->foreign("id_barang")->references("id")->on("master_barang");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembelian');
    }
}
